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
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;"> @csrf
    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
    </form>
  </div>
</div>

    <div class="container">
    <div class="card shadow radius">
        <div class="card-header">Dashboard Admin</div>
        <div class="card-body">
        <div class="grid">

        </div>
        </div>
    </div>
    </div>
  
</body>
</html>
