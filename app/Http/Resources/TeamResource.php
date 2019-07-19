<?php

namespace App\Http\Resources;

use App\Models\Team;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $team = $this->resource;

        if (empty($team) || ! ($team instanceof Team)) {
            return null;
        }

        return [
            'id'         => $team->id,
            'name'       => $team->name,
            'slug'       => $team->slug,
            'created_at' => $team->created_at,
            'updated_at' => $team->updated_at,
        ];
    }
}
