<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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



// Mostra form per inserire email
Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Invia email con link di reset
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Mostra form per inserire nuova password (dopo aver cliccato nel link)
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Salva nuova password
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
