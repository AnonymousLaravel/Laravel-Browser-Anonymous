<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Browser</title>

    <!-- Tailwind CSS da CDN (opzionale se stai usando Vite) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Il tuo CSS compilato -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    
<script>
  if (localStorage.getItem('theme') === 'dark' ||
      (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
</script>
</head>


<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    @yield('content')
    <script src="{{ asset(path: 'js/js.js') }}" defer></script>
</body>


</html>