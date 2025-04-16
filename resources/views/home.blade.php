@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">
    <!-- Titolo -->
    <h1 class="text-4xl font-semibold text-gray-800 mb-8 tracking-tight">Laravel Browser</h1>

    <!-- Form di Ricerca -->
    <form action="{{ route('home') }}" method="GET" class="flex items-center gap-2 mb-6">
        <input 
            type="text" 
            name="q" 
            placeholder="Cerca nel web..." 
            value="{{ request('q') }}"
            class="flex-grow px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
        >
        <button 
            type="submit" 
            class="bg-blue-600 text-white px-6 py-3 rounded-xl shadow hover:bg-blue-700 transition-all"
        >
            Cerca
        </button>
    </form>

    <!-- Risultati -->
    @if(request('q'))
        @if($results->isNotEmpty())
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Risultati per <span class="text-blue-600">"{{ request('q') }}"</span></h2>
            <ul class="space-y-6">
                @foreach($results as $page)
                    <li class="p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                        <a href="{{ $page->url }}" target="_blank" class="text-blue-600 text-lg font-medium hover:underline">
                            {{ $page->title }}
                        </a>
                        <p class="text-sm text-gray-500 mt-1">{{ $page->url }}</p>
                    </li>
                @endforeach
            </ul>

            <!-- Paginazione -->
            <div class="mt-10 flex justify-center">
                {{ $results->appends(['q' => request('q')])->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <p class="text-gray-500">Nessun risultato trovato per <strong>"{{ request('q') }}"</strong>.</p>
        @endif
    @endif
</div>
@endsection
