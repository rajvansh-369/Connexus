<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', [ChatController::class, 'index'])->name('chat');;

Route::get('/', function () {
    return redirect('/login');
})->middleware('auth.session_check');

// Route::get('/ping', function() {

//     broadcast(new \App\Events\TestBroadcast('Hello from Laravel Reverb! Snehal'));
//    event(new \App\Events\TestBroadcast('Hello from Laravel Reverb! Snehal'));
//     return view('welcome');
// });


Route::get('/ping', function() {
    broadcast(new \App\Events\TestBroadcast('Hello from Laravel Reverb! Snehal'));
    return view('welcome');
});

Route::get('/test-broadcast', function () {
    event(new \App\Events\TestBroadcast('Hello World from broadcast!'));
    return 'Broadcast event triggered!';
});

// Route::get('/test-broadcast', function () {
//     \Log::info('About to broadcast');
    
//     $event = new \App\Events\TestBroadcast('Hello World');
//     \Log::info('Event instance created', ['event' => get_class($event)]);
    
//     $result = event($event);
//     \Log::info('Event dispatched', ['result' => $result]);
    
//     return 'Check logs and Reverb terminal';
// });

Route::get('/test-event', function () {
    \Log::info('Before dispatching event');
    event(new \App\Events\TestBroadcast('Hello from route!'));
    \Log::info('After dispatching event');
    return 'Event dispatched - check logs and browser';
});

// Route::get('/test-chat', function () {
//     return view('pages.chat');
// });

Route::get('/test-chat', [ChatController::class, 'testChat'])->name('testChat');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
});
