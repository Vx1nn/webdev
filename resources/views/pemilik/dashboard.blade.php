<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<div class="navbar">
  <a href="{{ route('pemilik.dashboard') }}" class="navbar-brand">
    <img src="{{ asset('assets/img/unair-logo.png') }}" alt="UNAIR Logo">
    RSHP UNAIR
  </a>
  <div class="navbar-links">
    <a href="{{ route('pemilik.dashboard') }}">Home</a>
    <a href="{{ route('login') }}">Logout</a>
  </div>
</div>

<div class="container">
  <div class="card shadow radius">
    <div class="card-header">Dashboard Pemilik</div>
    <div class="card-body">
      <p>Selamat datang, <strong>{{ $user->nama }}</strong>! Berikut hewan peliharaan Anda:</p>
      <table class="data-table">
        <thead><tr><th>Nama Hewan</th><th>Ras</th><th>Kategori</th><th>Umur</th><th>Jenis Kelamin</th></tr></thead>
        <tbody>
        @forelse($pets as $pet)
          <tr>
            <td>{{ $pet->nama_hewan }}</td>
            <td>{{ $pet->ras->nama_ras ?? '-' }}</td>
            <td>{{ $pet->kategori->nama_kategori ?? '-' }}</td>
            <td>{{ $pet->umur }}</td>
            <td>{{ ucfirst($pet->jenis_kelamin) }}</td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center">Belum ada hewan terdaftar.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>