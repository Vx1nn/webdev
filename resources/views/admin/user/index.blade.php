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
    <div class="card-header">Daftar User & Role</div>
    <div class="card-body">
      <div class="table-wrapper">
        <table class="data-table">
        <thead style="background: var(--blue); color:white;">
          <tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th></tr>
        </thead>
        <tbody>
          @foreach($data as $u)
          <tr>
            <td>{{ $u->iduser }}</td>
            <td>{{ $u->nama }}</td>
            <td>{{ $u->email }}</td>
            <td>
              @foreach($u->roles as $r)
                <span>{{ $r->nama_role }}</span>
              @endforeach
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>