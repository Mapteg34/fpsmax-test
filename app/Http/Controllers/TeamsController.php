<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamsController extends AbstractController
{
    public function index()
    {
        return Team::paginate();
    }
}
