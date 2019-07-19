<?php

namespace App\Http\Resources;

use App\Models\League;
use Illuminate\Http\Resources\Json\JsonResource;

class LeagueResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $league = $this->resource;

        if (empty($league) || ! ($league instanceof League)) {
            return null;
        }

        return [
            'id'         => $league->id,
            'name'       => $league->name,
            'slug'       => $league->slug,
            'url'        => $league->url,
            'created_at' => $league->created_at,
            'updated_at' => $league->updated_at,
        ];
    }
}
