@extends('layouts.app')

@section('content')

    {{-- Dropdown Menu Button --}}
    <div class="absolute top-4 right-4 z-50">
        <button id="menu-toggle"
            class="w-10 h-10 p-2 rounded-full bg-white dark:bg-gray-800 shadow-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <svg class="w-6 h-6 text-gray-800 dark:text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div id="menu-dropdown"
            class="hidden absolute right-0 mt-2 w-44 bg-white dark:bg-gray-800 rounded-xl shadow-lg z-50 opacity-0 pointer-events-none transition-all duration-300">
            <a href="{{route('profile.edit')}}"
                class="block px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Profile</a>
            <a href="{{ route('home') }}"
                class="block px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Home</a>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </div>

    {{-- Theme Toggle Button --}}
    <div class="absolute top-4 right-20 z-50">
        <button id="theme-toggle"
            class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg id="theme-icon-light" class="w-6 h-6 text-black dark:text-white hidden" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
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

    <div class="max-w-4xl mx-auto px-6 py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Cronologia delle tue ricerche</h1>
            @if($logs->isNotEmpty())
                <form action="{{ route('logs.clear') }}" method="POST"
                    onsubmit="return confirm('Sei sicuro di voler cancellare tutta la cronologia?');">
                    @csrf
                    @method('DELETE') 
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg shadow transition">
                        Cancella tutto
                    </button>
                </form>

            @endif
        </div>

        @if($logs->isEmpty())
            <div class="p-6 bg-blue-50 dark:bg-gray-700 rounded-lg text-blue-800 dark:text-blue-200 text-center">
                Non ci sono ricerche da mostrare.
            </div>
        @else
            <ul class="space-y-4">
                @foreach($logs->sortByDesc('created_at') as $log)
                    <li
                        class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg transition">
                        <div class="flex justify-between items-center">
                            <a href="{{ $log->page->url }}" target="_blank"
                                class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                                {{ Str::limit($log->page->title, 60) }}
                            </a>
                            <form action="{{ route('logs.delete', $log) }}" method="POST" class="ml-4">
                                @csrf @method('DELETE')
                                <button type="submit" title="Elimina" class="text-gray-400 hover:text-red-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Cercata il {{ $log->created_at->format('d/m/Y H:i') }}
                        </p>
                    </li>
                @endforeach
            </ul>

            <div class="pagination">
                <div class="mt-10 flex justify-center">
                    {{ $logs->appends(['q' => request('q')])->links('vendor.pagination.tailwind') }}
                </div>
        @endif
        </div>


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
        <script>
            // Theme toggle
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
                localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
                syncIcons();
            });
        </script>

@endsection