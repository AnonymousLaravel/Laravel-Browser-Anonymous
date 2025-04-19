@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <div>
            <h2 class="text-center text-3xl font-bold text-gray-900 dark:text-white">
                Accedi al tuo account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-300">
                oppure <a href="{{ route('register') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">registrati</a>
            </p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded text-sm">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                           class="appearance-none rounded w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input id="password" name="password" type="password" required
                           class="appearance-none rounded w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2">
                    Ricordami
                </label>
            </div>

            <div>
                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Accedi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
