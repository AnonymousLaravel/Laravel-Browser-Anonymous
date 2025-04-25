<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Mostra la form con i dati correnti
    public function edit()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    // Valida e salva i cambiamenti, poi redirect con status
    public function update(Request $request)
    {
        $user = Auth::user();

        // Regole di validazione
        $rules = [
            'name'                 => 'required|string|max:255',
            'email'                => 'required|email|unique:users,email,' . $user->id,
            'current_password'     => 'required_with:password|current_password', 
            'password'             => 'nullable|string|min:8|confirmed',
        ];

        $request->validate($rules);

        // Aggiorna nome & email
        $user->name  = $request->name;
        $user->email = $request->email;

        // Se ha inserito una nuova password, la cripto e la salva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
               ->route('profile.edit')
               ->with('status', 'Profilo aggiornato correttamente.');
    }
}
