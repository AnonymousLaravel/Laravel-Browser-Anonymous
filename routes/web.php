<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;


// Home protetta
Route::get('/', [SearchController::class, 'index'])
     ->middleware('auth')
     ->name('home');

// Login
Route::get('login', [AuthController::class, 'show'])
     ->middleware('guest')
     ->name('login'); // ← nome corretto per i redirect interni
Route::post('login', [AuthController::class, 'login'])
     ->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])
     ->middleware('auth')
     ->name('logout');

// Registrazione
Route::get('register', [RegisterController::class, 'show'])
     ->middleware('guest')
     ->name('register');
Route::post('register', [RegisterController::class, 'register'])
     ->middleware('guest');
