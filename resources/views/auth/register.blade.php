<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrati</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
  <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded shadow">
    <h1 class="mb-6 text-2xl text-center text-gray-800 dark:text-gray-100">Registrati</h1>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
      @csrf

      <div>
        <label class="block text-gray-700 dark:text-gray-300">Nome</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus
               class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
        @error('name')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-gray-700 dark:text-gray-300">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
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

      <div>
        <label class="block text-gray-700 dark:text-gray-300">Conferma Password</label>
        <input type="password" name="password_confirmation" required
               class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
      </div>

      <button type="submit"
        class="w-full py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
        Registrati
      </button>

      <p class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
        Hai già un account?
        <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
          Accedi
        </a>
      </p>
    </form>
    
  </div>
</body>
</html>
