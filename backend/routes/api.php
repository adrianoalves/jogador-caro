<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [\App\Http\Controllers\UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new \App\Http\Resources\UserResource($request->user());
});

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(\App\Http\Controllers\MatchDayController::class)->group(function() {

        Route::get('match', 'list');
        Route::get('match/{match}', 'index');
        Route::post('match', 'create');
    });

    Route::controller(\App\Http\Controllers\MatchPlayerController::class)->group(function() {

        Route::get('match-players/{match_id}', 'index');
        Route::put('match-player/confirmation', 'updateConfirmation');
    });

    Route::controller(\App\Http\Controllers\SquadController::class)->group(function() {

        Route::get('squads/{match_id}', 'list');
        Route::post('squad/mount', 'mount');
    });

});
