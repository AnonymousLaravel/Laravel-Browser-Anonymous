@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="absolute top-4 right-4 z-50">
        <button id="menu-toggle"
            class="w-10 h-10 p-2 rounded-full bg-white dark:bg-gray-800 shadow-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <svg class="w-6 h-6 text-gray-800 dark:text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div id="menu-dropdown"
            class="hidden absolute right-0 mt-2 w-44 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50 opacity-0 pointer-events-none transition-all duration-300">
            <a href="{{route('profile.edit')}}"
                class="block px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Profile</a>
            <a href="{{ route('logs') }}"
                class="block px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Log</a>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Logout</button>
            </form>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-10">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-semibold text-gray-800 dark:text-gray-100 tracking-tight">Laravel Browser</h1>

            <div class="flex items-center space-x-4">
                <!-- Theme toggle button -->
                <button id="theme-toggle" class="w-10 h-10 flex items-center justify-center p-0 rounded-full
                                                    bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600
                                                    transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg id="theme-icon-light" class="w-6 h-6 text-black dark:text-white hidden" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3 m15.364 6.364l-.707-.707 M6.343 6.343l-.707-.707 m12.728 0l-.707.707 M6.343 17.657l-.707.707" />
                    </svg>
                    <svg id="theme-icon-dark" class="w-6 h-6 text-black dark:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21 a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

            </div>
        </div>

        <form action="{{ route('home') }}" method="GET" class="flex items-center gap-2 mb-6">
            <input type="text" name="q" placeholder="Cerca nel web..." value="{{ $query }}"
                class="flex-grow px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100">
            <button type="submit"
                class="bg-blue-600 dark:bg-blue-700 text-white px-6 py-3 rounded-xl shadow hover:bg-blue-700 dark:hover:bg-blue-800 transition-all">
                Cerca
            </button>
        </form>

        @if(request()->isMethod('get') && request()->has('q') && trim(request('q')) === '')
            <div class="mb-4 p-4 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-lg">
                Per favore inserisci un termine di ricerca.
            </div>
        @endif

        @if($results->isNotEmpty())
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Risultati per <span
                    class="text-blue-600 dark:text-blue-400">"{{ request('q') }}"</span></h2>
            <ul class="space-y-6">
                @foreach($results as $page)
                    <li
                        class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-md transition bg-white dark:bg-gray-800">
                        <a href="{{ $page->url }}" target="_blank"
                            class="text-blue-600 dark:text-blue-400 text-lg font-medium hover:no-underline">
                            {{ $page->title }}
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $page->url }}</p>
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="pagination">
                <div class="mt-10 flex justify-center">
                    {{ $results->appends(['q' => request('q')])->links('vendor.pagination.tailwind') }}
                </div>
        @endif

        </div>
    </div>

    <script>

        // Theme toggle functionality
        const themeBtn = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('theme-icon-light');
        const moonIcon = document.getElementById('theme-icon-dark');

        function syncIcons() {
            const isDark = document.documentElement.classList.contains('dark');
            sunIcon.style.display = isDark ? 'block' : 'none';
            moonIcon.style.display = isDark ? 'none' : 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (saved === 'dark' || (!saved && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            syncIcons();
        });

        themeBtn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            const nowDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', nowDark ? 'dark' : 'light');
            syncIcons();
        });
    </script>


    <script>
        // Burger menu functionality
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const menu = document.getElementById('menu-dropdown');
            const isVisible = !menu.classList.contains('hidden');

            menu.classList.toggle('hidden');

            // Toggle the transition for visibility
            menu.style.opacity = isVisible ? '0' : '1';
            menu.style.pointerEvents = isVisible ? 'none' : 'auto';
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (event) {
            const menu = document.getElementById('menu-dropdown');
            const button = document.getElementById('menu-toggle');

            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
                menu.style.opacity = '0';
                menu.style.pointerEvents = 'none';
            }
        });
    </script>
@endsection