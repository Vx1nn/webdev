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
  <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
    <img src="{{ asset('assets/img/unair-logo.png') }}" alt="UNAIR Logo">
    RSHP UNAIR
  </a>
  <div class="navbar-links">
    <a href="{{ route('admin.dashboard') }}">Data Master</a>
    <a href="{{ route('login') }}">Logout</a>
  </div>
</div>

<div class="container">
  <div class="card shadow radius">
    <div class="card-header">
      Daftar Kode Tindakan Terapi
      <a href="{{ route('admin.kode-terapi.create') }}" class="btn-login" style="float:right;">+ Tambah Data</a>
    </div>
    <div class="card-body">
      @if (session('success'))
        <div class="alert success">{{ session('success') }}</div>
      @endif

      <table class="data-table">
        <thead>
          <tr><th>No</th><th>Kode</th><th>Nama Terapi</th><th>Harga</th></tr>
        </thead>
        <tbody>
          @foreach($data as $i => $row)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $row->kode }}</td>
            <td>{{ $row->nama_terapi }}</td>
            <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>