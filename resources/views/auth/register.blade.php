<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrati</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">

</head>
<body>
  <div class="login-card">
    <div class="login-header">
      <h1 class="login-title">RedMB - Anonymous</h1>
      <h2 class="login-subtitle">Registrati</h2>
    </div>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-group">
        <label class="form-label">Nome</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus class="form-input">
        @error('name')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="form-input">
        @error('email')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" required class="form-input">
        @error('password')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Conferma Password</label>
        <input type="password" name="password_confirmation" required class="form-input">
      </div>

      <button type="submit" class="auth-button">
        Registrati
      </button>

      <div class="auth-footer">
        Hai già un account?
        <a href="{{ route('login') }}" class="auth-link">Accedi</a>
      </div>
    </form>
  </div>
</body>
</html>
