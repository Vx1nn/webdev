@extends('layouts.app')

@section('content')
<div class="container text-center" style="margin-top: 80px;">
  <h1 style="font-size: 3rem; color: var(--blue);">403</h1>
  <p style="font-size: 1.2rem;">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
  <a href="{{ url()->previous() }}" class="btn btn-blue">Kembali</a>
</div>
@endsection
