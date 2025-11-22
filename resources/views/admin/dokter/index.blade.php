@extends('layouts.lte.main')

@section('content')

	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">Data Dokter</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="#">Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Dokter</li>
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
					<h3 class="card-title mb-0">Daftar Dokter</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
							<i class="bi bi-plus-circle me-1"></i> Tambah Dokter
						</button>
					</div>
				</div>

				<div class="card-body">
					<x-search-bar placeholder="Cari nama, email, bidang, atau no. HP..." />
				</div>

				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover table-striped mb-0">
							<thead class="table-light">
								<tr>
									<th style="width: 60px">#</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Alamat</th>
									<th>No HP</th>
									<th>Bidang Dokter</th>
									<th>Jenis Kelamin</th>
									<th style="width: 150px">Aksi</th>
								</tr>
							</thead>

							<tbody>
								@forelse($data as $dokter)
									<tr class="align-middle">
										<td>{{ $loop->iteration }}</td>
										<td><strong>{{ $dokter->user->nama ?? '-' }}</strong></td>
										<td>{{ $dokter->user->email ?? '-' }}</td>
										<td>{{ $dokter->alamat ?? '-' }}</td>
										<td>{{ $dokter->no_hp ?? '-' }}</td>
										<td>{{ $dokter->bidang_dokter ?? '-' }}</td>
										<td>{{ $dokter->jenis_kelamin_text }}</td>
										<td>
											<button class="btn btn-sm btn-warning" data-bs-toggle="modal"
												data-bs-target="#editModal{{ $dokter->id_dokter }}">
												<i class="bi bi-pencil"></i>
											</button>
											<button class="btn btn-sm btn-danger" data-bs-toggle="modal"
												data-bs-target="#deleteModal{{ $dokter->id_dokter }}">
												<i class="bi bi-trash"></i>
											</button>
										</td>
									</tr>

									<!-- Edit Modal -->
									<div class="modal fade" id="editModal{{ $dokter->id_dokter }}" tabindex="-1">
										<div class="modal-dialog">
											<div class="modal-content">
												<form action="{{ route('admin.dokter.edit', $dokter->id_dokter) }}"
													method="POST">
													@csrf
													<div class="modal-header">
														<h5 class="modal-title">Edit Data Dokter</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														<div class="mb-3">
															<label class="form-label">Nama <span
																	class="text-danger">*</span></label>
															<input type="text" name="nama" class="form-control"
																value="{{ $dokter->user->nama }}" required>
														</div>
														<div class="mb-3">
															<label class="form-label">Alamat <span
																	class="text-danger">*</span></label>
															<textarea name="alamat" class="form-control" rows="3"
																required>{{ $dokter->alamat }}</textarea>
														</div>
														<div class="mb-3">
															<label class="form-label">No HP <span
																	class="text-danger">*</span></label>
															<input type="text" name="no_hp" class="form-control"
																value="{{ $dokter->no_hp }}" required>
														</div>
														<div class="mb-3">
															<label class="form-label">Bidang Dokter <span
																	class="text-danger">*</span></label>
															<input type="text" name="bidang_dokter" class="form-control"
																value="{{ $dokter->bidang_dokter }}" required>
														</div>
														<div class="mb-3">
															<label class="form-label">Jenis Kelamin <span
																	class="text-danger">*</span></label>
															<select name="jenis_kelamin" class="form-control" required>
																<option value="L" {{ $dokter->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
																<option value="P" {{ $dokter->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary"
															data-bs-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
													</div>
												</form>
											</div>
										</div>
									</div>

									<!-- Delete Modal -->
									<div class="modal fade" id="deleteModal{{ $dokter->id_dokter }}" tabindex="-1">
										<div class="modal-dialog">
											<div class="modal-content">
												<form action="{{ route('admin.dokter.delete', $dokter->id_dokter) }}"
													method="POST">
													@csrf
													<div class="modal-header">
														<h5 class="modal-title">Hapus Data Dokter</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														<p>Apakah Anda yakin ingin menghapus data dokter
															<strong>{{ $dokter->user->nama }}</strong>?</p>
														<p class="text-danger"><small>Data yang sudah dihapus tidak dapat
																dikembalikan.</small></p>
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
								@empty
									<tr>
										<td colspan="8" class="text-center text-muted">Belum ada data dokter</td>
									</tr>
								@endforelse
							</tbody>

						</table>
					</div>
				</div>

				<div class="card-footer">
					{{ $data->links() }}
				</div>

			</div>

		</div>
	</div>

	<!-- Add Modal -->
	<div class="modal fade" id="addModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('admin.dokter.store') }}" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title">Tambah Data Dokter</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<x-validation-errors />
						<div class="mb-3">
							<label class="form-label">Nama <span class="text-danger">*</span></label>
							<input type="text" name="nama" class="form-control" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Email <span class="text-danger">*</span></label>
							<input type="email" name="email" class="form-control" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Password <span class="text-danger">*</span></label>
							<input type="password" name="password" class="form-control" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Alamat <span class="text-danger">*</span></label>
							<textarea name="alamat" class="form-control" rows="3" required></textarea>
						</div>
						<div class="mb-3">
							<label class="form-label">No HP <span class="text-danger">*</span></label>
							<input type="text" name="no_hp" class="form-control" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Bidang Dokter <span class="text-danger">*</span></label>
							<input type="text" name="bidang_dokter" class="form-control" placeholder="Contoh: Bedah, Umum"
								required>
						</div>
						<div class="mb-3">
							<label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
							<select name="jenis_kelamin" class="form-control" required>
								<option value="">-- Pilih Jenis Kelamin --</option>
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
							</select>
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
