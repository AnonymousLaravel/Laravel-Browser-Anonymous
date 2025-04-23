<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Page;
use App\Models\Log;
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

        if ($query) {

            $results = Page::query()
                ->where('title', 'like', '%' . $query . '%')
                ->orWhere('url', 'like', '%' . $query . '%')
                ->paginate(10) // Paginazione con 10 risultati per pagina
                ->withQueryString(); // Mantieni la query nei link di paginazione



            foreach ($results as $page) {
                $log = Log::create([
                    'session_id' => Session::getId(),
                    'page_id' => $page->id,
                    'user_id' => Auth::id(),
                ]);
            }
        }

        $message = $results->isEmpty() ? 'Nessun risultato trovato per la tua ricerca.' : null;

        return view('home', compact('results', 'message', 'query'));
    }
}
