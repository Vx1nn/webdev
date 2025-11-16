@extends('layouts.lte.main')

@section('content')

  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Ras Hewan</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ras Hewan</li>
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
            <h3 class="card-title mb-0">Daftar Ras Hewan</h3>

            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahRas">
              <i class="bi bi-plus-lg"></i> Tambah Ras
            </button>
          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 60px">#</th>
                  <th>Nama Ras</th>
                  <th>Jenis Hewan</th>
                  <th style="width: 160px">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @foreach($data as $ras)
                  <tr class="align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ras->nama_ras }}</td>
                    <td>{{ $ras->jenisHewan->nama_jenis_hewan ?? '-' }}</td>

                    <td>
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                        data-bs-target="#modalEditRas{{ $ras->idras_hewan }}">
                        Edit
                      </button>

                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalHapusRas{{ $ras->idras_hewan }}">
                        Hapus
                      </button>
                    </td>
                  </tr>

                  <div class="modal fade" id="modalEditRas{{ $ras->idras_hewan }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form method="post" action="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}">
                          @csrf

                          <div class="modal-header">
                            <h5 class="modal-title">Edit Ras Hewan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            <label class="form-label">Nama Ras</label>
                            <input name="nama_ras" class="form-control mb-2" value="{{ $ras->nama_ras }}">

                            <label class="form-label">Jenis Hewan</label>
                            <select name="idjenis_hewan" class="form-select">
                              @foreach($jenis as $j)
                                <option value="{{ $j->idjenis_hewan }}" {{ $j->idjenis_hewan == $ras->idjenis_hewan ? 'selected' : '' }}>
                                  {{ $j->nama_jenis_hewan }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Update</button>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="modalHapusRas{{ $ras->idras_hewan }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form method="post" action="{{ route('admin.ras-hewan.delete', $ras->idras_hewan) }}">
                          @csrf

                          <div class="modal-header">
                            <h5 class="modal-title">Hapus Ras Hewan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            Yakin ingin menghapus ras
                            <strong>{{ $ras->nama_ras }}</strong>?
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

  <div class="modal fade" id="modalTambahRas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="{{ route('admin.ras-hewan.store') }}">
          @csrf

          <div class="modal-header">
            <h5 class="modal-title">Tambah Ras Hewan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <label class="form-label">Nama Ras</label>
            <input name="nama_ras" class="form-control mb-2">

            <label class="form-label">Jenis Hewan</label>
            <select name="idjenis_hewan" class="form-select">
              @foreach($jenis as $j)
                <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
              @endforeach
            </select>
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
