<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', [ChatController::class, 'index'])->name('chat');;

Route::get('/', function () {

    // dd(auth()->user());
    if(auth()->user() != null) {
        return redirect('/chat');
    }else{
        return redirect('/login');

    }

});


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth.session')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
});