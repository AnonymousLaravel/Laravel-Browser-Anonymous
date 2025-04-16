@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Motore di Ricerca - Laravel Browser</h1>
    <form action="{{ route('home') }}" method="GET" class="mb-4">
        <input type="text" name="q" placeholder="Inserisci termini di ricerca" 
               class="w-full p-2 border rounded" value="{{ request('q') }}">
        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">
            Cerca
        </button>
    </form>

    @if(request('q'))
        @if($results->isNotEmpty())
            <h2 class="text-2xl font-semibold mb-2">Risultati</h2>
            <ul class="space-y-2">
                @foreach($results as $page)
                    <li class="p-2 border rounded">
                        <a href="{{ $page->url }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ $page->title }}
                        </a>
                        <div class="text-sm text-gray-500">
                            {{ $page->url }}
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Nessun risultato trovato per "{{ request('q') }}".</p>
        @endif
    @endif
@endsection
