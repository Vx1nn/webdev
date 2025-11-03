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
    <div class="card-header">Tambah Kategori Baru</div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="nama_kategori">Nama Kategori Hewan</label>
          <input type="text" id="nama_kategori" name="nama_kategori"
                 placeholder="Contoh: Peliharaan" value="{{ old('nama_kategori') }}" required>
        </div>

        <button type="submit" class="btn-login">Simpan</button>
        <a href="{{ route('admin.kategori.index') }}" class="btn-cancel">Batal</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>