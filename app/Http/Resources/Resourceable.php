<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Responsable;

interface Resourceable extends Responsable
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request);

    /**
     * @return string|null
     */
    public function getModelClass();
}
