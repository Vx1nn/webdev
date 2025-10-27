<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | RSHP</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
  @include('layouts.navbar')

  <div class="login-container">
    <div class="login-card shadow radius">
      <h2>Login ke RSHP</h2>

      @if (session('status'))
        <div class="alert success">{{ session('status') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert error">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
          <label for="email">Alamat Email</label>
          <input id="email" type="email" name="email"
                 class="@error('email') is-invalid @enderror"
                 placeholder="Masukkan email"
                 value="{{ old('email') }}" required autofocus>
          @error('email')
            <small style="color:red;">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="password">Kata Sandi</label>
          <input id="password" type="password" name="password"
                 class="@error('password') is-invalid @enderror"
                 placeholder="Masukkan password" required>
          @error('password')
            <small style="color:red;">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group" style="display: flex; align-items:center; justify-content:space-between;">
          <label style="display: flex; align-items: center; gap: 6px;">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span style="font-size: smaller;">Ingat saya</span>
          </label>

          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" style="font-size: 0.9rem; color: var(--blue); text-decoration: none;">
              Lupa kata sandi?
            </a>
          @endif
        </div>

        <button type="submit" class="btn-login">Masuk</button>
        
        {{-- On Progress --}}
        <div style="margin-top: 12px; font-size: 0.9rem; text-align: center;">
          Belum punya akun?
          <a href="{{ route('register') }}" style="color: var(--blue); text-decoration: none;">
            Daftar di sini
          </a>
        </div>
      </form>
    </div>
  </div>

  <footer class="footer">
    <p>&copy; 2025 Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
  </footer>
</body>
</html>
