<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostra il form di login
    public function showLoginForm()
    {
        return view('login');
    }

    // Processa il login
    public function login(Request $request)
    {
        // Validazione automatica
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentativo di login con Auth::attempt()
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate(); // Previene session fixation
            return redirect()->intended('/dashboard'); // Redirect post-login
        }

        // Fallimento
        return back()->withErrors([
            'email' => 'Credenziali non valide.',
        ]);
    }
}