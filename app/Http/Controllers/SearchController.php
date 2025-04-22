<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    // Mostra la pagina di ricerca (home page)
    public function index(Request $request)
    {
        $query = $request->input('q');

        $query = trim($query); // Rimuovi spazi bianchi all'inizio e alla fine
        
        
        $validator = Validator::make($request->all(), [
            'q' => 'nullable|string|min:3|max:255',  // Limita la lunghezza della query
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        }

        $results = collect();

        // Esegui la ricerca solo se la query è presente
        if ($query) {
            $results = Page::query()
                ->where('title', 'like', '%' . $query . '%')
                ->orWhere('url', 'like', '%' . $query . '%')
                ->paginate(10) // Paginazione con 10 risultati per pagina
                ->withQueryString(); // Mantieni la query nei link di paginazione
        }

        $message = $results->isEmpty() ? 'Nessun risultato trovato per la tua ricerca.' : null;

        return view('home', compact('results', 'message', 'query'));
    }
}
