<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class SearchController extends Controller
{
    // Mostra la pagina di ricerca (home page)
    public function index(Request $request)
    {
        $results = [];
        if ($request->has('q')) {
            $query = $request->input('q');
            // Effettua una ricerca semplice per title o url
            $results = Page::where('title', 'like', '%' . $query . '%')
                           ->orWhere('url', 'like', '%' . $query . '%')
                           ->get();
        }

        return view('home', compact('results'));
    }
}
