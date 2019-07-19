<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

trait ResourceableTrait
{
    public function getModelClass()
    {
        return get_class($this);
    }

    /**
     * @param $request
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @return mixed
     */
    public function toResponse($request)
    {
        return app()
            ->make(JsonResource::class, [
                'resource' => $this,
            ])
            ->toResponse($request);
    }
}
