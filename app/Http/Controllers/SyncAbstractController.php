<?php

namespace App\Http\Controllers;

use App\Jobs\SyncJob;
use Illuminate\Http\Response;

class SyncAbstractController extends AbstractController
{
    public function sync()
    {
        SyncJob::dispatch();

        return response()->noContent(Response::HTTP_ACCEPTED);
    }
}
