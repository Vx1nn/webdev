<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Perawat</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<div class="navbar">
  <a href="{{ route('perawat.dashboard') }}" class="navbar-brand">
    <img src="{{ asset('assets/img/unair-logo.png') }}" alt="UNAIR Logo">
    RSHP UNAIR
  </a>
  <div class="navbar-links">
    <a href="{{ route('perawat.dashboard') }}">Data Master</a>
    <a href="{{ route('login') }}">Logout</a>
  </div>
</div>
<div class="container">
  <div class="card shadow radius">
    <div class="card-header">Dashboard Perawat</div>
    <div class="card-body">
      <p>Berikut daftar kategori klinis dan kode terapi (read-only):</p>
      <h3 class="sub-title">Kategori Klinis</h3>
      <ul>
        @foreach($kategori_klinis as $k)
          <li>{{ $k->nama_kategori_klinis }}</li>
        @endforeach
      </ul>

      <h3 class="sub-title">Kode Terapi</h3>
      <table class="data-table">
        <thead><tr><th>Kode</th><th>Nama Terapi</th><th>Harga</th></tr></thead>
        <tbody>
        @foreach($kode_terapi as $t)
          <tr><td>{{ $t->kode }}</td><td>{{ $t->nama_terapi }}</td><td>Rp {{ number_format($t->harga,0,',','.') }}</td></tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
