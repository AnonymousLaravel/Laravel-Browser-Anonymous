<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Browser</title>
    <!-- Includi Tailwind CSS da CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>

<body class="bg-gray-100">
    <br>
    <div class="container mx-auto p-4">
        @yield('content')
    </div>
</body>

</html>