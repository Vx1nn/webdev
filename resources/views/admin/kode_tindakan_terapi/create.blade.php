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
    <div class="card-header">Tambah Kode Tindakan Terapi Baru</div>
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

      <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="kode">Kode Tindakan</label>
          <input type="text" id="kode" name="kode"
                 placeholder="Contoh: TRP001" value="{{ old('kode') }}" required>
        </div>

        <div class="form-group">
          <label for="nama_terapi">Nama Tindakan Terapi</label>
          <input type="text" id="nama_terapi" name="nama_terapi"
                 placeholder="Contoh: Pemberian Vitamin C"
                 value="{{ old('nama_terapi') }}" required>
        </div>

        <div class="form-group">
          <label for="harga">Harga (Rp)</label>
          <input type="number" id="harga" name="harga"
                 placeholder="Contoh: 50000" value="{{ old('harga') }}" required>
        </div>

        <button type="submit" class="btn-login">Simpan</button>
        <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn-cancel">Batal</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>