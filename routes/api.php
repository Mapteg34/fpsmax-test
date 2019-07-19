<?php

use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\SyncAbstractController;
use App\Http\Controllers\TeamsController;
use Illuminate\Support\Facades\Route;

Route::post('sync', [SyncAbstractController::class, 'sync']);
Route::get('leagues', [LeaguesController::class, 'index']);
Route::get('teams', [TeamsController::class, 'index']);
Route::get('matches', [MatchesController::class, 'index']);
