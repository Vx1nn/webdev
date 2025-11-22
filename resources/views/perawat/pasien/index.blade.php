@extends('layouts.lte.main')

@section('content')

  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Data Pasien</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Perawat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pasien</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title mb-0">Daftar Pasien (Pet)</h3>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 60px">#</th>
                  <th>Nama Pet</th>
                  <th>Jenis Kelamin</th>
                  <th>Ras</th>
                  <th>Jenis Hewan</th>
                  <th>Pemilik</th>
                  <th>Jumlah Rekam Medis</th>
                </tr>
              </thead>

              <tbody>
                @foreach($data as $pet)
                  <tr class="align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pet->nama }}</td>
                    <td>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : ($pet->jenis_kelamin == 'B' ? 'Betina' : '-') }}</td>
                    <td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                    <td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                    <td>{{ $pet->pemilik->user->nama ?? '-' }}</td>
                    <td>{{ $pet->rekamMedis->count() }}</td>
                  </tr>
                @endforeach
              </tbody>

            </table>
          </div>
        </div>

      </div>

    </div>
  </div>

@endsection
