@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">
    <!-- Header with Theme Toggle -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-semibold text-gray-800 dark:text-gray-100 tracking-tight">Laravel Browser</h1>
        <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
            <svg id="theme-icon-light" class="w-6 h-6 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
            </svg>
            <svg id="theme-icon-dark" class="w-6 h-6 text-gray-800 dark:text-gray-200 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        </button>
    </div>

    <!-- Search Form -->
    <form action="{{ route('home') }}" method="GET" class="flex items-center gap-2 mb-6">
        <input 
            type="text" 
            name="q" 
            placeholder="Cerca nel web..." 
            value="{{ request('q') }}"
            class="flex-grow px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100"
        >
        <button 
            type="submit" 
            class="bg-blue-600 dark:bg-blue-700 text-white px-6 py-3 rounded-xl shadow hover:bg-blue-700 dark:hover:bg-blue-800 transition-all"
        >
            Cerca
        </button>
    </form>

    <!-- Results -->
    @if(request('q'))
        @if($results->isNotEmpty())
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Risultati per <span class="text-blue-600 dark:text-blue-400">"{{ request('q') }}"</span></h2>
            <ul class="space-y-6">
                @foreach($results as $page)
                    <li class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-md transition bg-white dark:bg-gray-800">
                        <a href="{{ $page->url }}" target="_blank" class="text-blue-600 dark:text-blue-400 text-lg font-medium hover:underline">
                            {{ $page->title }}
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $page->url }}</p>
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{ $results->appends(['q' => request('q')])->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">Nessun risultato trovato per <strong>"{{ request('q') }}"</strong>.</p>
        @endif
    @endif
</div>

<!-- Theme Toggle Script -->
<script>
    const themeToggle = document.getElementById('theme-toggle');
    const themeIconLight = document.getElementById('theme-icon-light');
    const themeIconDark = document.getElementById('theme-icon-dark');

    // Check for saved theme or system preference
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        themeIconLight.classList.add('hidden');
        themeIconDark.classList.remove('hidden');
    }

    // Toggle theme on button click
    themeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        const isDark = document.documentElement.classList.contains('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        
        // Toggle icons
        themeIconLight.classList.toggle('hidden');
        themeIconDark.classList.toggle('hidden');
    });
</script>
@endsection