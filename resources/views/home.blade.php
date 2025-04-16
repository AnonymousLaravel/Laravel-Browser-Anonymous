@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
            <h1 class="text-4xl font-extrabold text-center text-blue-600 mb-8">
                🔍 Laravel Browser
            </h1>

            <form action="{{ route('home') }}" method="GET" class="flex flex-col sm:flex-row gap-4 mb-6">
                <input type="text" name="q" placeholder="Cerca una pagina o un termine..."
                    class="flex-1 p-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    value="{{ request('q') }}">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 shadow-md">
                    Cerca
                </button>
            </form>

            @if(request('q'))
                @if($results->isNotEmpty())
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700">
                        Risultati per "{{ request('q') }}"
                    </h2>
                    <div class="space-y-4">
                        @foreach($results as $page)
                            <div class="p-4 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                                <a href="{{ $page->url }}" target="_blank" class="text-lg font-medium text-blue-600 hover:underline">
                                    {{ $page->title }}
                                </a>
                                <div class="text-sm text-gray-500 mt-1">
                                    {{ $page->url }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- PAGINAZIONE -->
                    <div class="mt-8">
                        {{ $results->appends(['q' => request('q')])->links('vendor.pagination.tailwind') }}
                    </div>
                @else
                    <div class="text-center text-red-500 font-semibold mt-6">
                        Nessun risultato trovato per "{{ request('q') }}".
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection