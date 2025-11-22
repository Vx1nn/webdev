@extends('layouts.lte.main')

@section('content')

  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Jadwal Temu Dokter</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Pemilik</a></li>
            <li class="breadcrumb-item active" aria-current="page">Temu Dokter</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title mb-0">Riwayat Temu Dokter</h3>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 60px">#</th>
                  <th>No. Urut</th>
                  <th>Waktu Daftar</th>
                  <th>Pet</th>
                  <th>Dokter</th>
                  <th>Status</th>
                  <th>Rekam Medis</th>
                </tr>
              </thead>

              <tbody>
                @forelse($data as $temu)
                  <tr class="align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $temu->no_urut ?? '-' }}</strong></td>
                    <td>@formatDateTime($temu->waktu_daftar)</td>
                    <td>{{ $temu->pet->nama ?? '-' }}</td>
                    <td>{{ $temu->roleUser->user->nama ?? '-' }}</td>
                    <td>
                      @if($temu->status == '1')
                        <span class="badge bg-success">Selesai</span>
                      @else
                        <span class="badge bg-warning">Menunggu</span>
                      @endif
                    </td>
                    <td>
                      @if($temu->idrekam_medis)
                        <a href="{{ route('pemilik.rekam-medis.show', $temu->idrekam_medis) }}" class="btn btn-sm btn-info">
                          Lihat
                        </a>
                      @else
                        <span class="text-muted">-</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada jadwal temu dokter</td>
                  </tr>
                @endforelse
              </tbody>

            </table>
          </div>
        </div>

      </div>

    </div>
  </div>

@endsection