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
            <li class="breadcrumb-item"><a href="#">Resepsionis</a></li>
            <li class="breadcrumb-item active" aria-current="page">Temu Dokter</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title mb-0">Daftar Temu Dokter</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="bi bi-plus-circle me-1"></i> Buat Janji
            </button>
          </div>
        </div>

        <div class="card-body">
          <x-search-bar placeholder="Cari nama pet, pemilik, atau dokter..." />
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 60px">#</th>
                  <th>No. Urut</th>
                  <th>Pet</th>
                  <th>Pemilik</th>
                  <th>Dokter</th>
                  <th>Waktu Daftar</th>
                  <th>Status</th>
                  <th style="width: 150px">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($data as $temu)
                  <tr class="align-middle">
                    <td>{{ $data->firstItem() + $loop->index }}</td>
                    <td><strong>{{ $temu->no_urut ?? '-' }}</strong></td>
                    <td>{{ $temu->pet->nama ?? '-' }}</td>
                    <td>{{ $temu->pet->pemilik->user->nama ?? '-' }}</td>
                    <td>{{ $temu->roleUser->user->nama ?? '-' }}</td>
                    <td>@formatDateTime($temu->waktu_daftar)</td>
                    <td>
                      @if($temu->status == '1')
                        <span class="badge bg-success">Selesai</span>
                      @else
                        <span class="badge bg-warning">Menunggu</span>
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $temu->idtemu_dokter }}">
                        <i class="bi bi-pencil"></i>
                      </button>
                    </td>
                  </tr>

                  <!-- Edit Modal -->
                  <div class="modal fade" id="editModal{{ $temu->idtemu_dokter }}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{ route('resepsionis.temu-dokter.edit', $temu->idtemu_dokter) }}" method="POST">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Jadwal Temu Dokter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Pet <span class="text-danger">*</span></label>
                              <select name="idpet" class="form-control" required>
                                @foreach($pets as $pet)
                                  <option value="{{ $pet->idpet }}" {{ $temu->idpet == $pet->idpet ? 'selected' : '' }}>
                                    {{ $pet->nama }} ({{ $pet->pemilik->user->nama ?? '-' }})
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Dokter <span class="text-danger">*</span></label>
                              <select name="idrole_user" class="form-control" required>
                                @foreach($dokters as $dokter)
                                  <option value="{{ $dokter->idrole_user }}" {{ $temu->idrole_user == $dokter->idrole_user ? 'selected' : '' }}>
                                    {{ $dokter->user->nama }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Waktu Daftar <span class="text-danger">*</span></label>
                              <input type="datetime-local" name="waktu_daftar" class="form-control" 
                                value="{{ $temu->waktu_daftar ? \Carbon\Carbon::parse($temu->waktu_daftar)->format('Y-m-d\TH:i') : '' }}" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">No. Urut</label>
                              <input type="number" name="no_urut" class="form-control" value="{{ $temu->no_urut }}">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Status <span class="text-danger">*</span></label>
                              <select name="status" class="form-control" required>
                                <option value="0" {{ $temu->status == '0' ? 'selected' : '' }}>Menunggu</option>
                                <option value="1" {{ $temu->status == '1' ? 'selected' : '' }}>Selesai</option>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @empty
                  <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada jadwal temu dokter</td>
                  </tr>
                @endforelse
              </tbody>

            </table>
          </div>
        </div>

        @if($data->hasPages())
        <div class="card-footer clearfix">
          {{ $data->links() }}
        </div>
        @endif

      </div>

    </div>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Jadwal Temu Dokter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Pet <span class="text-danger">*</span></label>
              <select name="idpet" class="form-control" required>
                <option value="">-- Pilih Pet --</option>
                @foreach($pets as $pet)
                  <option value="{{ $pet->idpet }}">{{ $pet->nama }} ({{ $pet->pemilik->user->nama ?? '-' }})</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Dokter <span class="text-danger">*</span></label>
              <select name="idrole_user" class="form-control" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach($dokters as $dokter)
                  <option value="{{ $dokter->idrole_user }}">{{ $dokter->user->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Waktu Daftar <span class="text-danger">*</span></label>
              <input type="datetime-local" name="waktu_daftar" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">No. Urut</label>
              <input type="number" name="no_urut" class="form-control" placeholder="Opsional">
            </div>
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