<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;

class ResourceableEloquentCollection extends Collection implements Resourceable
{
    use ResourceableTrait;

    public function getModelClass()
    {
        return $this->getQueueableClass();
    }
}

