@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">RedMB - Anonymous</h1>
            <h2 class="login-subtitle">Imposta nuova password</h2>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input id="email" name="email" type="email" required class="form-input" placeholder="Email" value="{{ $email ?? old('email') }}" >
            </div>

            <div class="form-group">
                <input id="password" name="password" type="password" required class="form-input" placeholder="Nuova password">
            </div>

            <div class="form-group">
                <input id="password_confirmation" name="password_confirmation" type="password" required class="form-input" placeholder="Conferma password">
            </div>

            <button type="submit" class="login-button">Resetta password</button>
        </form>
    </div>
</div>
@endsection
