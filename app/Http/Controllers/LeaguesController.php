<?php

namespace App\Http\Controllers;

use App\Models\League;

class LeaguesController extends AbstractController
{
    public function index()
    {
        return League::paginate();
    }
}
