<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\CustomPlayerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\NextEventController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::get('/events', [NextEventController::class, 'index']);
Route::get('/events/{id}', [NextEventController::class, 'show']);



Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('teams', TeamController::class);
    Route::post('teams/{team}/players', [PlayerController::class, 'store']);
    Route::delete('teams/{team}/players/{player}', [PlayerController::class, 'destroy']);
    Route::post('/teams/{team}/events/{event}/assign', [TeamController::class, 'assignToEvent']);
});

Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/teams/{teamId}/custom-players', [CustomPlayerController::class, 'store']);
// });



Route::delete('/teams/{team}/players/{player}', [PlayerController::class, 'destroy']);
