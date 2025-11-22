@extends('layouts.lte.main')

@section('content')

  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Rekam Medis</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Perawat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rekam Medis</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      <div class="card mb-4">
        <div class="card-header">
          <div class="d-flex w-100 justify-content-between align-items-center">
            <h3 class="card-title mb-0">Daftar Rekam Medis</h3>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahRekamMedis">
              <i class="bi bi-plus-lg"></i> Tambah Rekam Medis
            </button>
          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 60px">#</th>
                  <th>Tanggal</th>
                  <th>Pet</th>
                  <th>Pemilik</th>
                  <th>Dokter Pemeriksa</th>
                  <th>Diagnosa</th>
                  <th style="width: 200px">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @foreach($data as $rm)
                  <tr class="align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td>@formatDateTime($rm->created_at)</td>
                    <td>{{ $rm->pet->nama ?? '-' }}</td>
                    <td>{{ $rm->pet->pemilik->user->nama ?? '-' }}</td>
                    <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                    <td>{{ \Str::limit($rm->diagnosa, 40) }}</td>
                    <td>
                      <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-info">
                        Lihat
                      </a>
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                        data-bs-target="#modalEditRekamMedis{{ $rm->idrekam_medis }}">
                        Edit
                      </button>
                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalHapusRekamMedis{{ $rm->idrekam_medis }}">
                        Hapus
                      </button>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="modalEditRekamMedis{{ $rm->idrekam_medis }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <form method="post" action="{{ route('perawat.rekam-medis.edit', $rm->idrekam_medis) }}">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Rekam Medis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <label class="form-label">Pet</label>
                            <select name="idpet" class="form-select mb-2" required>
                              @foreach($pets as $pet)
                                <option value="{{ $pet->idpet }}" {{ $pet->idpet == $rm->idpet ? 'selected' : '' }}>
                                  {{ $pet->nama }} - {{ $pet->pemilik->user->nama ?? '' }}
                                </option>
                              @endforeach
                            </select>

                            <label class="form-label">Dokter Pemeriksa</label>
                            <select name="dokter_pemeriksa" class="form-select mb-2" required>
                              @foreach($dokters as $dok)
                                <option value="{{ $dok->idrole_user }}" {{ $dok->idrole_user == $rm->dokter_pemeriksa ? 'selected' : '' }}>
                                  {{ $dok->user->nama }}
                                </option>
                              @endforeach
                            </select>

                            <label class="form-label">Anamnesa</label>
                            <textarea name="anamnesa" class="form-control mb-2" rows="3"
                              required>{{ $rm->anamnesa }}</textarea>

                            <label class="form-label">Temuan Klinis</label>
                            <textarea name="temuan_klinis" class="form-control mb-2" rows="3"
                              required>{{ $rm->temuan_klinis }}</textarea>

                            <label class="form-label">Diagnosa</label>
                            <textarea name="diagnosa" class="form-control mb-2" rows="3"
                              required>{{ $rm->diagnosa }}</textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Hapus -->
                  <div class="modal fade" id="modalHapusRekamMedis{{ $rm->idrekam_medis }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form method="post" action="{{ route('perawat.rekam-medis.delete', $rm->idrekam_medis) }}">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title">Hapus Rekam Medis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus rekam medis untuk <strong>{{ $rm->pet->nama }}</strong>?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                @endforeach
              </tbody>

            </table>
          </div>
        </div>

      </div>

    </div>
  </div>

  <!-- Modal Tambah -->
  <div class="modal fade" id="modalTambahRekamMedis" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <form method="post" action="{{ route('perawat.rekam-medis.store') }}">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Rekam Medis</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <label class="form-label">Pet</label>
            <select name="idpet" class="form-select mb-2" required>
              <option value="">-- Pilih Pet --</option>
              @foreach($pets as $pet)
                <option value="{{ $pet->idpet }}">
                  {{ $pet->nama }} - {{ $pet->pemilik->user->nama ?? '' }}
                </option>
              @endforeach
            </select>

            <label class="form-label">Dokter Pemeriksa</label>
            <select name="dokter_pemeriksa" class="form-select mb-2" required>
              <option value="">-- Pilih Dokter --</option>
              @foreach($dokters as $dok)
                <option value="{{ $dok->idrole_user }}">
                  {{ $dok->user->nama }}
                </option>
              @endforeach
            </select>

            <label class="form-label">Anamnesa</label>
            <textarea name="anamnesa" class="form-control mb-2" rows="3" required
              placeholder="Keluhan dan riwayat penyakit"></textarea>

            <label class="form-label">Temuan Klinis</label>
            <textarea name="temuan_klinis" class="form-control mb-2" rows="3" required
              placeholder="Hasil pemeriksaan fisik"></textarea>

            <label class="form-label">Diagnosa</label>
            <textarea name="diagnosa" class="form-control mb-2" rows="3" required
              placeholder="Diagnosa penyakit"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection