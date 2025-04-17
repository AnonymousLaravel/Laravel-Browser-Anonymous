@extends('layouts.app') <!-- Usa un layout comune -->

@section('content')
<div class="container">
    <form method="POST" action="{{ route('login') }}">
        @csrf <!-- Token CSRF automatico -->

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Ricordami</label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection