<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded shadow">
        <h1 class="mb-6 text-2xl text-center text-gray-800 dark:text-gray-100">Accedi</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center text-gray-700 dark:text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2">
                    Ricordami
                </label>
            </div>
            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Login
            </button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            Non hai un account?
            <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                Registrati
            </a>
        </p>

    </div>
</body>

</html>