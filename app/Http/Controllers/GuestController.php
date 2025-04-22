<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class GuestController extends Controller
{
    // Mostra la pagina di ricerca (home page)
    public function index(Request $request)
    {
        $query = $request->input('q');

        $results = collect(); // default vuoto

        if ($query) {
            $results = Page::where('title', 'like', '%' . $query . '%')
                ->orWhere('url', 'like', '%' . $query . '%')
                ->paginate(10); // ✅ usa paginate invece di get()
        }

        return view('guest_home', compact('results'));
    }

}
