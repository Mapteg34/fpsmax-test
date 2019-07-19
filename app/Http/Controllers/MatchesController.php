<?php

namespace App\Http\Controllers;

use App\Models\Match;

class MatchesController extends AbstractController
{
    public function index()
    {
        return Match::paginate();
    }
}
