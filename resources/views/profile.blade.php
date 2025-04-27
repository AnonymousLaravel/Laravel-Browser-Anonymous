@extends('layouts.manage')

@section('content')

<div class="absolute top-4 right-4 z-50 flex items-center justify-end gap-x-3">

  <button id="theme-toggle" class="w-10 h-10 flex items-center justify-center p-0 rounded-full
                  bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600
                  transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
    <svg id="theme-icon-light" class="w-6 h-6 text-black dark:text-white hidden" fill="none" stroke="currentColor"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707" />
    </svg>
    <svg id="theme-icon-dark" class="w-6 h-6 text-black dark:text-white" fill="none" stroke="currentColor"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
    </svg>
  </button>

  <!-- Bottone menu -->
  <div class="relative">
    <button id="menu-toggle"
      class="w-10 h-10 p-2 rounded-full bg-white dark:bg-gray-800 shadow-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
      <svg class="w-6 h-6 text-gray-800 dark:text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Dropdown -->
    <div id="menu-dropdown"
      class="hidden absolute right-0 mt-2 w-44 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50 opacity-0 pointer-events-none transition-all duration-300">
      <a href="{{ route('home') }}"
        class="block px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Home</a>
      <a href="{{ route('logs') }}"
        class="block px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Log</a>
      <form method="POST" action="{{ route('logout') }}" class="m-0">
        @csrf
        <button type="submit"
          class="w-full text-left px-4 py-2 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Logout</button>
      </form>
    </div>
  </div>
</div>

<div class="max-w-md mx-auto mt-16 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg" id="main-content">
  <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">
    Aggiorna il profilo
  </h2>

  @if(session('status'))
  <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
    {{ session('status') }}
  </div>
  @endif

  <form method="POST" action="{{ route('profile.edit') }}" novalidate>
    @csrf
    @method('PATCH')

    {{-- Nome --}}
    <div class="mb-4">
      <label for="name" class="block text-gray-700 dark:text-gray-300 mb-1">Nome</label>
      <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring
          @error('name') border-red-500 @else border-gray-300 @enderror
          dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
      @error('name')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Email --}}
    <div class="mb-4">
      <label for="email" class="block text-gray-700 dark:text-gray-300 mb-1">Email</label>
      <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring
          @error('email') border-red-500 @else border-gray-300 @enderror
          dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
      @error('email')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Vecchia password --}}
    <div class="mb-4">
      <label for="current_password" class="block text-gray-700 dark:text-gray-300 mb-1">
        Password attuale
      </label>
      <input id="current_password" name="current_password" type="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring
          @error('current_password') border-red-500 @else border-gray-300 @enderror
          dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
      @error('current_password')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Nuova password --}}
    <div class="mb-4">
      <label for="password" class="block text-gray-700 dark:text-gray-300 mb-1">
        Nuova password
      </label>
      <input id="password" name="password" type="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring
          @error('password') border-red-500 @else border-gray-300 @enderror
          dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
      @error('password')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Conferma nuova password --}}
    <div class="mb-6">
      <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 mb-1">
        Conferma nuova password
      </label>
      <input id="password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring
          dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
    </div>

    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition">
      Salva modifiche
    </button>
  </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const themeToggle = document.getElementById('theme-toggle');
  const htmlElement = document.documentElement;
  const lightIcon = document.getElementById('theme-icon-light');
  const darkIcon = document.getElementById('theme-icon-dark');

  function setTheme(theme) {
    if (theme === 'dark') {
      htmlElement.classList.add('dark');
      lightIcon.classList.remove('hidden');
      darkIcon.classList.add('hidden');
    } else {
      htmlElement.classList.remove('dark');
      darkIcon.classList.remove('hidden');
      lightIcon.classList.add('hidden');
    }
  }

  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    setTheme(savedTheme);
  } else {
    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
      setTheme('dark');
    } else {
      setTheme('light');
    }
  }

  themeToggle.addEventListener('click', () => {
    const currentTheme = htmlElement.classList.contains('dark') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    setTheme(newTheme);
    localStorage.setItem('theme', newTheme);
  });

  // Menu dropdown toggle
  const menuToggle = document.getElementById('menu-toggle');
  const menuDropdown = document.getElementById('menu-dropdown');

  menuToggle.addEventListener('click', () => {
    menuDropdown.classList.toggle('hidden');
    menuDropdown.classList.toggle('opacity-0');
    menuDropdown.classList.toggle('pointer-events-none');
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', (event) => {
    if (!menuToggle.contains(event.target) && !menuDropdown.contains(event.target)) {
      menuDropdown.classList.add('hidden');
      menuDropdown.classList.add('opacity-0');
      menuDropdown.classList.add('pointer-events-none');
    }
  });
});
</script>
@endpush
