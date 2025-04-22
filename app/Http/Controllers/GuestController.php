<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Auth; 

class GuestController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home'); // solo se sei loggato
        }

        $query = $request->input('q');
        $results = collect(); // default vuoto

        if ($query) {
            $results = Page::where('title', 'like', '%' . $query . '%')
                ->orWhere('url', 'like', '%' . $query . '%')
                ->paginate(10);
        }

        return view('guest_home', compact('results'));
    }
}
