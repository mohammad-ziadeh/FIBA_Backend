<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\NextEventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::resource('users', UserController::class);

Route::post('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::delete('/users/{user}/delete-permanently', [UserController::class, 'deletePermanently'])->name('users.deletePermanently');


Route::resource('events', NextEventController::class);

Route::post('/events/{event}/restore', [NextEventController::class, 'restore'])->name('events.restore');

Route::delete('/events/{event}/delete-permanently', [NextEventController::class, 'deletePermanently'])->name('events.deletePermanently');

require __DIR__ . '/auth.php';




// Web Image Flutter



Route::get('/cors-image/{filename}', function ($filename) {
    $path = storage_path('app/public/events/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return Response::make($file, 200, [
        'Content-Type' => $type,
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept',
    ]);
})->where('filename', '.*'); 