<?php

namespace App\Jobs;

use App\Models\League;
use App\Models\Match;
use App\Models\Team;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const PER_PAGE = 100;

    /** @var \GuzzleHttp\Client */
    private $client;

    /** @var int */
    private $currentPage = 0;

    /** @var int */
    private $total = 0;

    /** @var \Illuminate\Support\Collection */
    private $matches;

    /**
     * @param \GuzzleHttp\Client $client
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function handle(Client $client)
    {
        $this->client  = $client;
        $this->matches = collect([]);

        do {
            $this->loadNextPage();
        } while ($this->matches->count() < $this->total);

        $this->syncLeagues();
        $this->syncTeams();
        $this->syncMatches();
    }

    /**
     * @throws \Exception
     */
    private function syncLeagues()
    {
        // sync leagues
        League::unguard();
        $this->matches->unique('league_id')
                      ->each(function ($match) {
                          $leagueModel = League::findOrNew($match['league_id']);
                          $leagueModel->fill([
                              'id'   => $match['league_id'],
                              'name' => $match['league']['name'],
                              'slug' => $match['league']['slug'],
                              'url'  => $match['league']['url'],
                          ]);
                          $leagueModel->saveOrFail();
                      });
        League::reguard();

        // clean leagues
        $existsLeaguesIds = $this->matches->pluck('league_id')
                                          ->unique();
        League::whereNotIn('id', $existsLeaguesIds)
              ->delete();
    }

    /**
     * @throws \Exception
     */
    private function syncTeams()
    {
        $teams = $this->matches->pluck('opponents')
                               ->flatten(1)
                               ->where('type', '=', 'Team')
                               ->pluck('opponent')
                               ->unique('id');

        // sync teams
        Team::unguard();
        $teams->each(function ($opponent) {
            $teamModel = Team::findOrNew($opponent['id']);
            $teamModel->fill([
                'id'   => $opponent['id'],
                'name' => $opponent['name'],
                'slug' => $opponent['slug'],
            ]);
            $teamModel->saveOrFail();
        });
        Team::reguard();

        // clean teams
        Team::whereNotIn('id', $teams->pluck('id'))
            ->delete();
    }

    /**
     * @throws \Exception
     */
    private function syncMatches()
    {
        // sync matches
        Match::unguard();
        $this->matches->each(function ($match) {
            $matchModel = Match::findOrNew($match['id']);
            $matchModel->fill([
                'id'         => $match['id'],
                'begin_at'   => Carbon::parse($match['begin_at']),
                'end_at'     => Carbon::parse($match['end_at']),
                'league_id'  => $match['league_id'],
                'match_type' => $match['match_type'],
                'name'       => $match['name'],
            ]);
            $matchModel->saveOrFail();

            $teamsIds = collect($match['opponents'])
                ->where('type', '=', 'Team')
                ->pluck('id')
                ->unique();

            // @TODO: проверить когда апи будет снова доступно...
            // $matchModel->teams()
            //           ->sync($teamsIds);
        });
        Match::reguard();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    private function loadNextPage()
    {
        /** @noinspection SpellCheckingInspection */
        $response = $this->client->request('GET', 'https://api.pandascore.co/csgo/matches/upcoming', [
            'query' => [
                'token'    => 'w1LTZz2BV4yFn_WstE2SMJY_nxXQ-LPRCv5by9T7BqcdHrQ7oYU', // @TODO: from config/env/settings
                'per_page' => static::PER_PAGE,
                'page'     => $this->currentPage,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Failed get matches from external api');
        }

        $this->total = $response->getHeader('X-Total');
        $this->currentPage++;

        $this->matches = $this->matches->merge(collect(json_decode($response->getBody(), true)));
    }
}
