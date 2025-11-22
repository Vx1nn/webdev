@extends('layouts.lte.main')

@section('content')

	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">Role</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="#">Data Master</a></li>
						<li class="breadcrumb-item active" aria-current="page">Role</li>
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
						<h3 class="card-title mb-0">Daftar Role</h3>

						<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahRole">
							<i class="bi bi-plus-lg"></i> Tambah Role
						</button>
					</div>
				</div>

				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover table-striped mb-0">
							<thead class="table-light">
								<tr>
									<th style="width: 60px">#</th>
									<th>Nama Role</th>
									<th style="width: 140px">Aksi</th>
								</tr>
							</thead>

							<tbody>
								@foreach($data as $role)
									<tr class="align-middle">
										<td>{{ $loop->iteration }}</td>
										<td>{{ $role->nama_role }}</td>
										<td>
											<button class="btn btn-sm btn-warning" data-bs-toggle="modal"
												data-bs-target="#modalEditRole{{ $role->idrole }}">
												Edit
											</button>

											<button class="btn btn-sm btn-danger" data-bs-toggle="modal"
												data-bs-target="#modalHapusRole{{ $role->idrole }}">
												Hapus
											</button>
										</td>
									</tr>

									<div class="modal fade" id="modalEditRole{{ $role->idrole }}" tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form method="post" action="{{ route('admin.role.edit', $role->idrole) }}">
													@csrf

													<div class="modal-header">
														<h5 class="modal-title">Edit Role</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>

													<div class="modal-body">
														<label class="form-label">Nama Role</label>
														<input name="nama_role" class="form-control"
															value="{{ $role->nama_role }}">
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

									<div class="modal fade" id="modalHapusRole{{ $role->idrole }}" tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form method="post" action="{{ route('admin.role.delete', $role->idrole) }}">
													@csrf

													<div class="modal-header">
														<h5 class="modal-title">Hapus Role</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>

													<div class="modal-body">
														<p>Yakin ingin menghapus role <strong>{{ $role->nama_role }}</strong>?
														</p>
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

	<div class="modal fade" id="modalTambahRole" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="post" action="{{ route('admin.role.store') }}">
					@csrf

					<div class="modal-header">
						<h5 class="modal-title">Tambah Role</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
						<label class="form-label">Nama Role</label>
						<input name="nama_role" class="form-control">
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