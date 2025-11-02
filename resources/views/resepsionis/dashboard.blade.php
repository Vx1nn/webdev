<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Resepsionis</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<div class="navbar">
  <a href="{{ route('resepsionis.dashboard') }}" class="navbar-brand">
    <img src="{{ asset('assets/img/unair-logo.png') }}" alt="UNAIR Logo">
    RSHP UNAIR
  </a>
  <div class="navbar-links">
    <a href="{{ route('resepsionis.dashboard') }}">Data Master</a>
    <a href="{{ route('login') }}">Logout</a>
  </div>
</div>

<div class="container">
  <div class="card shadow radius">
    <div class="card-header">Dashboard Resepsionis</div>
    <div class="card-body">
      <p>Daftar hewan yang terdaftar:</p>
      <table class="data-table">
        <thead>
          <tr><th>Nama Hewan</th><th>Ras</th><th>Kategori</th><th>Pemilik</th></tr>
        </thead>
        <tbody>
          @foreach($pet as $p)
          <tr>
            <td>{{ $p->nama_hewan }}</td>
            <td>{{ $p->ras->nama_ras ?? '-' }}</td>
            <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
            <td>{{ $p->user->nama ?? '-' }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
