<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
@include( 'layouts.navbar')
<div class="login-container">
  <div class="login-card">
    <h2>Login ke RSHP</h2>

    @if (session('success'))
      <div class="alert success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert error">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Masukkan email" required value="{{ old('email') }}">
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
      </div>

      <button type="submit" class="btn-login">Masuk</button>
    </form>
  </div>
</div>

  <footer class="footer">
    <p>&copy; 2025 Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
  </footer>
</body>
</html>
