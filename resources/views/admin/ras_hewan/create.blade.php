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
    <div class="card-header">Tambah Ras Hewan Baru</div>
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

      <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="nama_ras">Nama Ras Hewan</label>
          <input type="text" id="nama_ras" name="nama_ras"
                 placeholder="Contoh: Persia" value="{{ old('nama_ras') }}" required>
        </div>

        <div class="form-group">
          <label for="idjenis_hewan">Jenis Hewan</label>
          <select id="idjenis_hewan" name="idjenis_hewan" required>
            <option value="">-- Pilih Jenis Hewan --</option>
            @foreach($jenis as $j)
              <option value="{{ $j->idjenis_hewan }}" {{ old('idjenis_hewan') == $j->idjenis_hewan ? 'selected' : '' }}>
                {{ $j->nama_jenis }}
              </option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn-login">Simpan</button>
        <a href="{{ route('admin.ras-hewan.index') }}" class="btn-cancel">Batal</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>


