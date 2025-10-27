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
        <div class="card-header">Dashboard Admin</div>
        <div class="card-body">
        <div class="grid">
            <a href="{{ route('admin.user') }}" class="list-item hover-lift hover-lift">Daftar User</a>
            <a href="{{ route('admin.role') }}" class="list-item hover-lift hover-lift">Daftar Role</a>
            <a href="{{ route('admin.jenis-hewan') }}" class="list-item hover-lift hover-lift">Daftar Jenis Hewan</a>
            <a href="{{ route('admin.ras-hewan') }}" class="list-item hover-lift hover-lift">Daftar Ras Hewan</a>
            <a href="{{ route('admin.kategori') }}" class="list-item hover-lift hover-lift">Daftar Kategori</a>
            <a href="{{ route('admin.kategori-klinis') }}" class="list-item hover-lift hover-lift">Daftar Kategori Klinis</a>
            <a href="{{ route('admin.kode-terapi') }}" class="list-item hover-lift hover-lift">Daftar Kode Tindakan Terapi</a>
            <a href="{{ route('admin.pet') }}" class="list-item hover-lift hover-lift">Daftar Pet</a>
        </div>
        </div>
    </div>
    </div>
  
</body>
</html>
