<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Laravel</title>
    
    <!-- Tailwind CSS da CDN (opzionale se stai usando Vite) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Il tuo CSS compilato -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>


<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    <div class="container mx-auto p-4">
        @yield('content')
    </div>
</html>
