<?php

use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\SimulatorController;
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
Route::resource('simulator', SimulatorController::class);
Route::get('player/leaderboard/{id}', [PlayerController::class, 'index']);
Route::post('player/leaderboard', [PlayerController::class, 'leaderboard']);
Route::resource('player', PlayerController::class);