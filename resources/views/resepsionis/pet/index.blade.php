@extends('layouts.lte.main')

@section('content')

  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Data Pet</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Resepsionis</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pet</li>
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
          <h3 class="card-title mb-0">Daftar Hewan Peliharaan</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
              <i class="bi bi-plus-circle me-1"></i> Tambah Pet
            </button>
          </div>
        </div>

        <div class="card-body">
          <x-search-bar placeholder="Cari nama pet, pemilik, atau ras..." />
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
                  <th>Tanggal Lahir</th>
                  <th>Warna/Tanda</th>
                  <th style="width: 150px">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($data as $pet)
                  <tr class="align-middle">
                    <td>{{ $data->firstItem() + $loop->index }}</td>
                    <td><strong>{{ $pet->nama }}</strong></td>
                    <td>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : ($pet->jenis_kelamin == 'B' ? 'Betina' : '-') }}</td>
                    <td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                    <td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                    <td>{{ $pet->pemilik->user->nama ?? '-' }}</td>
                    <td>@formatDate($pet->tanggal_lahir)</td>
                    <td>{{ $pet->warna_tanda ?? '-' }}</td>
                    <td>
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $pet->idpet }}">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pet->idpet }}">
                        <i class="bi bi-trash"></i>
                      </button>
                    </td>
                  </tr>

                  <!-- Edit Modal -->
                  <div class="modal fade" id="editModal{{ $pet->idpet }}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{ route('resepsionis.pet.edit', $pet->idpet) }}" method="POST">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Data Pet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Nama Pet <span class="text-danger">*</span></label>
                              <input type="text" name="nama" class="form-control" value="{{ $pet->nama }}" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Pemilik <span class="text-danger">*</span></label>
                              <select name="idpemilik" class="form-control" required>
                                @foreach($pemilikList as $pemilik)
                                  <option value="{{ $pemilik->idpemilik }}" {{ $pet->idpemilik == $pemilik->idpemilik ? 'selected' : '' }}>
                                    {{ $pemilik->user->nama }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Ras <span class="text-danger">*</span></label>
                              <select name="idras_hewan" class="form-control" required>
                                @foreach($rasList as $ras)
                                  <option value="{{ $ras->idras_hewan }}" {{ $pet->idras_hewan == $ras->idras_hewan ? 'selected' : '' }}>
                                    {{ $ras->nama_ras }} ({{ $ras->jenisHewan->nama_jenis_hewan ?? '-' }})
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                              <select name="jenis_kelamin" class="form-control" required>
                                <option value="J" {{ $pet->jenis_kelamin == 'J' ? 'selected' : '' }}>Jantan</option>
                                <option value="B" {{ $pet->jenis_kelamin == 'B' ? 'selected' : '' }}>Betina</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tanggal Lahir</label>
                              <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pet->tanggal_lahir }}">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Warna/Tanda</label>
                              <input type="text" name="warna_tanda" class="form-control" value="{{ $pet->warna_tanda }}">
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

                  <!-- Delete Modal -->
                  <div class="modal fade" id="deleteModal{{ $pet->idpet }}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{ route('resepsionis.pet.delete', $pet->idpet) }}" method="POST">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title">Hapus Data Pet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data pet <strong>{{ $pet->nama }}</strong>?</p>
                            <p class="text-danger"><small>Data yang sudah dihapus tidak dapat dikembalikan.</small></p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @empty
                  <tr>
                    <td colspan="9" class="text-center text-muted">Belum ada data pet</td>
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
        <form action="{{ route('resepsionis.pet.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Pet</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <x-validation-errors />
            <div class="mb-3">
              <label class="form-label">Nama Pet <span class="text-danger">*</span></label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Pemilik <span class="text-danger">*</span></label>
              <select name="idpemilik" class="form-control" required>
                <option value="">-- Pilih Pemilik --</option>
                @foreach($pemilikList as $pemilik)
                  <option value="{{ $pemilik->idpemilik }}">{{ $pemilik->user->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Ras <span class="text-danger">*</span></label>
              <select name="idras_hewan" class="form-control" required>
                <option value="">-- Pilih Ras --</option>
                @foreach($rasList as $ras)
                  <option value="{{ $ras->idras_hewan }}">{{ $ras->nama_ras }} ({{ $ras->jenisHewan->nama_jenis_hewan ?? '-' }})</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
              <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="J">Jantan</option>
                <option value="B">Betina</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Warna/Tanda</label>
              <input type="text" name="warna_tanda" class="form-control">
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