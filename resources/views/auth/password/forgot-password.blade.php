@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">RedMB - Anonymous</h1>
            <h2 class="login-subtitle">Password dimenticata</h2>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <input id="email" name="email" type="email" required autofocus class="form-input" placeholder="Inserisci la tua email">
            </div>

            <button type="submit" class="login-button">Invia link di reset</button>
        </form>

        <div class="login-footer">
            <a href="{{ route('login') }}" class="footer-link">Torna al login</a>
        </div>
    </div>
</div>
@endsection
