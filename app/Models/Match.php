<?php

namespace App\Models;

use App\Enums\MatchTypesEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Match
 *
 * @property int $id
 * @property \Carbon\Carbon $begin_at
 * @property \Carbon\Carbon $end_at
 * @property int $league_id
 * @property MatchTypesEnum $match_type
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\Models\League $league
 * @property-read Team[] $teams
 *
 * @mixin \Eloquent
 *
 * @package App\Models
 */
class Match extends Model
{
    protected $casts = [
        'match_type'   => MatchTypesEnum::class,
    ];

    protected $dates = [
        'begin_at',
        'end_at',
    ];

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}
