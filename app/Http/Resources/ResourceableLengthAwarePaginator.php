<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ResourceableLengthAwarePaginator extends LengthAwarePaginator implements Resourceable
{
    use ResourceableTrait;

    public function getModelClass()
    {
        if (! ($this->items instanceof Collection)) {
            return null;
        }

        return $this->items->getQueueableClass();
    }
}
