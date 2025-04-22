<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

// 1) ROTTE PER UTENTI GUEST (non loggati)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('login',  [AuthController::class, 'show'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    // Registrazione
    Route::get('register',  [RegisterController::class, 'show'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// 2) ROTTE PER UTENTI AUTENTICATI
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/', [SearchController::class, 'index'])->name('home');

    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
