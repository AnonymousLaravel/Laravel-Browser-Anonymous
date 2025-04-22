<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuestController;
use GuzzleHttp\Middleware;

Route::get('/',[GuestController::class, 'index'])->name('guest_home');


Route::middleware('guest')->group(function () {
    // mostra form di login
    Route::get('/login',  [AuthController::class, 'show'])->name('login');
    // processa login
    Route::post('/login', [AuthController::class, 'login']);

    // mostra form di registrazione
    Route::get('/register',  [RegisterController::class, 'show'])->name('register');
    // processa registrazione
    Route::post('/register', [RegisterController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| 3) Rotte auth (solo utenti loggati)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // home interna protetta
    Route::get('/home', [SearchController::class, 'index'])->name('home');

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
