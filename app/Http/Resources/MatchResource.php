<?php

namespace App\Http\Resources;

use App\Models\Match;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $match = $this->resource;

        if (empty($match) || ! ($match instanceof Match)) {
            return null;
        }

        return [
            'id'         => $match->id,
            'begin_at'   => $match->begin_at,
            'end_at'     => $match->end_at,
            'league_id'  => $match->league_id,
            'match_type' => $match->match_type,
            'name'       => $match->name,
            'created_at' => $match->created_at,
            'updated_at' => $match->updated_at,
        ];
    }
}
