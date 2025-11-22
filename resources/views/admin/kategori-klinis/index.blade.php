@extends('layouts.lte.main')

@section('content')

	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">Kategori Klinis</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="#">Data Master</a></li>
						<li class="breadcrumb-item active" aria-current="page">Kategori Klinis</li>
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
						<h3 class="card-title mb-0">Daftar Kategori Klinis</h3>

						<button class="btn btn-primary btn-sm" data-bs-toggle="modal"
							data-bs-target="#modalTambahKategoriKlinis">
							<i class="bi bi-plus-lg"></i> Tambah Kategori Klinis
						</button>
					</div>
				</div>

				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover table-striped mb-0">
							<thead class="table-light">
								<tr>
									<th style="width: 60px">#</th>
									<th>Nama Kategori Klinis</th>
									<th style="width: 160px">Aksi</th>
								</tr>
							</thead>

							<tbody>
								@foreach($data as $kategori)
									<tr class="align-middle">
										<td>{{ $loop->iteration }}</td>
										<td>{{ $kategori->nama_kategori_klinis }}</td>

										<td>
											<button class="btn btn-sm btn-warning" data-bs-toggle="modal"
												data-bs-target="#modalEditKategoriKlinis{{ $kategori->idkategori_klinis }}">
												Edit
											</button>

											<button class="btn btn-sm btn-danger" data-bs-toggle="modal"
												data-bs-target="#modalHapusKategoriKlinis{{ $kategori->idkategori_klinis }}">
												Hapus
											</button>
										</td>
									</tr>

									<div class="modal fade" id="modalEditKategoriKlinis{{ $kategori->idkategori_klinis }}"
										tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form method="post"
													action="{{ route('admin.kategori-klinis.edit', $kategori->idkategori_klinis) }}">
													@csrf

													<div class="modal-header">
														<h5 class="modal-title">Edit Kategori Klinis</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>

													<div class="modal-body">
														<label class="form-label">Nama Kategori Klinis</label>
														<input name="nama_kategori_klinis" class="form-control mb-2"
															value="{{ $kategori->nama_kategori_klinis }}">
													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-secondary"
															data-bs-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-warning">Update</button>
													</div>

												</form>
											</div>
										</div>
									</div>

									<div class="modal fade" id="modalHapusKategoriKlinis{{ $kategori->idkategori_klinis }}"
										tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form method="post"
													action="{{ route('admin.kategori-klinis.delete', $kategori->idkategori_klinis) }}">
													@csrf

													<div class="modal-header">
														<h5 class="modal-title">Hapus Kategori Klinis</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>

													<div class="modal-body">
														Yakin ingin menghapus kategori klinis
														<strong>{{ $kategori->nama_kategori_klinis }}</strong>?
													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-secondary"
															data-bs-dismiss="modal">Batal</button>
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

	<div class="modal fade" id="modalTambahKategoriKlinis" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="post" action="{{ route('admin.kategori-klinis.store') }}">
					@csrf

					<div class="modal-header">
						<h5 class="modal-title">Tambah Kategori Klinis</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
						<label class="form-label">Nama Kategori Klinis</label>
						<input name="nama_kategori_klinis" class="form-control mb-2">
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