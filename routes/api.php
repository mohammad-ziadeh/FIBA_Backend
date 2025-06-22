<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\CustomPlayerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\NextEventController;
use App\Http\Resources\NotificationResource;

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






Route::middleware('auth:sanctum')->group(function () {
    // Get all notifications
    Route::get('/notifications', function () {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return NotificationResource::collection($user->notifications);
    });

    // Get unread notifications count
    Route::get('/notifications/unread-count', function () {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return response()->json([
            'unread_count' => $user->unreadNotifications->count()
        ]);
    });

    // Mark single notification as read
    Route::post('/notifications/{id}/read', function ($id) {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['message' => 'Notification marked as read']);
    });

    // Mark all notifications as read
    Route::post('/notifications/read-all', function () {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $user->unreadNotifications->markAsRead();

        return response()->json(['message' => 'All notifications marked as read']);
    });

    // Delete single notification
    Route::delete('/notifications/{id}', function ($id) {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $notification = $user->notifications()->findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    });

    // Delete all notifications
    Route::delete('/notifications', function () {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $user->notifications()->delete();

        return response()->json(['message' => 'All notifications deleted']);
    });
});
