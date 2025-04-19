@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <!-- Login Card -->
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">Faairu</h1>
            <h2 class="login-subtitle">Sign in</h2>
        </div>

        @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <input id="email" name="email" type="email" required autofocus class="form-input" placeholder="Email Address">
            </div>

            <div class="form-group">
                <input id="password" name="password" type="password" required class="form-input" placeholder="Password">
            </div>

            <div class="flex items-center justify-between">
                <div class="checkbox-group">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="checkbox-label">Keep me signed in</label>
                </div>
                <a href="#" class="footer-link">Forgot password?</a>
            </div>

            <button type="submit" class="login-button">Sign in</button>
        </form>

        <div class="login-footer">
            <span class="footer-text">Don't have an account?</span>
            <a href="{{ route('register') }}" class="footer-link">Sign up</a>
        </div>
    </div>
</div>


@endsection