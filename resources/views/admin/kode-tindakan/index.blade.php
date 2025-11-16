@extends('layouts.lte.main')

@section('content')

  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Kode Tindakan Terapi</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kode Tindakan</li>
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
            <h3 class="card-title mb-0">Daftar Kode Tindakan</h3>

            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKode">
              <i class="bi bi-plus-lg"></i> Tambah Kode
            </button>
          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 90px">Kode</th>
                  <th>Deskripsi</th>
                  <th>Kategori Klinis</th>
                  <th style="width: 160px">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @foreach($data as $kode)
                  <tr class="align-middle">
                    <td>{{ $kode->kode }}</td>
                    <td>{{ $kode->deskripsi_tindakan_terapi }}</td>
                    <td>{{ $kode->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>

                    <td>
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                        data-bs-target="#modalEditKode{{ $kode->idkode_tindakan_terapi }}">
                        Edit
                      </button>

                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalHapusKode{{ $kode->idkode_tindakan_terapi }}">
                        Hapus
                      </button>
                    </td>
                  </tr>


                  {{-- Modal Edit --}}
                  <div class="modal fade" id="modalEditKode{{ $kode->idkode_tindakan_terapi }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form method="post" action="{{ route('admin.kode-tindakan.edit', $kode->idkode_tindakan_terapi) }}">
                          @csrf

                          <div class="modal-header">
                            <h5 class="modal-title">Edit Kode Tindakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            <label class="form-label">Kode</label>
                            <input name="kode" class="form-control mb-2" value="{{ $kode->kode }}">

                            <label class="form-label">Deskripsi</label>
                            <input name="deskripsi_tindakan_terapi" class="form-control mb-2"
                              value="{{ $kode->deskripsi_tindakan_terapi }}">

                            <label class="form-label">Kategori Klinis</label>
                            <select name="idkategori_klinis" class="form-select">
                              @foreach($kategori as $k)
                                <option value="{{ $k->idkategori_klinis }}" {{ $k->idkategori_klinis == $kode->idkategori_klinis ? 'selected' : '' }}>
                                  {{ $k->nama_kategori_klinis }}
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


                  {{-- Modal Hapus --}}
                  <div class="modal fade" id="modalHapusKode{{ $kode->idkode_tindakan_terapi }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form method="post"
                          action="{{ route('admin.kode-tindakan.delete', $kode->idkode_tindakan_terapi) }}">
                          @csrf

                          <div class="modal-header">
                            <h5 class="modal-title">Hapus Kode Tindakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            Yakin ingin menghapus tindakan:
                            <strong>{{ $kode->deskripsi_tindakan_terapi }}</strong>?
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


  {{-- Modal Tambah --}}
  <div class="modal fade" id="modalTambahKode" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="{{ route('admin.kode-tindakan.store') }}">
          @csrf

          <div class="modal-header">
            <h5 class="modal-title">Tambah Kode Tindakan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <label class="form-label">Kode</label>
            <input name="kode" class="form-control mb-2">

            <label class="form-label">Deskripsi</label>
            <input name="deskripsi_tindakan_terapi" class="form-control mb-2">

            <label class="form-label">Kategori Klinis</label>
            <select name="idkategori_klinis" class="form-select">
              @foreach($kategori as $k)
                <option value="{{ $k->idkategori_klinis }}">{{ $k->nama_kategori_klinis }}</option>
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
