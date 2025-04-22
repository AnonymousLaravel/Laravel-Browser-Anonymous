<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Rotte pubbliche
|--------------------------------------------------------------------------
| Qui definiamo tutte le rotte accessibili senza login.
*/

// Pagina iniziale aperta a tutti
Route::get('/', function () {
    return view('welcome');    // o quello che vuoi mostrare a tutti
})->name('welcome');




Route::middleware('auth')->group(function () {
    // Dashboard / Home vera e propria — solo loggati
    Route::get('/home', [SearchController::class, 'index'])->name('home');

    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
