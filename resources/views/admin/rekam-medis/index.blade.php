@extends('layouts.lte.main')

@section('content')

	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">Data Rekam Medis</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="#">Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Rekam Medis</li>
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
					<h3 class="card-title mb-0">Daftar Rekam Medis</h3>
				</div>

				<div class="card-body">
					<x-search-bar placeholder="Cari nama pet, pemilik, diagnosa..." />
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
									<th>Dokter</th>
									<th>Diagnosa</th>
									<th style="width: 150px">Aksi</th>
								</tr>
							</thead>

							<tbody>
								@forelse($data as $rekam)
									<tr class="align-middle">
										<td>{{ $loop->iteration }}</td>
										<td>@formatDate($rekam->created_at)</td>
										<td><strong>{{ $rekam->pet->nama ?? '-' }}</strong></td>
										<td>{{ $rekam->pet->pemilik->user->nama ?? '-' }}</td>
										<td>{{ $rekam->dokter->user->nama ?? '-' }}</td>
										<td>{{ Str::limit($rekam->diagnosa ?? '-', 50) }}</td>
										<td>
											<a href="{{ route('admin.rekam-medis.show', $rekam->idrekam_medis) }}"
												class="btn btn-sm btn-info" title="Lihat Detail">
												<i class="bi bi-eye"></i>
											</a>
											<button class="btn btn-sm btn-danger" data-bs-toggle="modal"
												data-bs-target="#deleteModal{{ $rekam->idrekam_medis }}" title="Hapus">
												<i class="bi bi-trash"></i>
											</button>
										</td>
									</tr>

									<!-- Delete Modal -->
									<div class="modal fade" id="deleteModal{{ $rekam->idrekam_medis }}" tabindex="-1">
										<div class="modal-dialog">
											<div class="modal-content">
												<form action="{{ route('admin.rekam-medis.delete', $rekam->idrekam_medis) }}"
													method="POST">
													@csrf
													<div class="modal-header">
														<h5 class="modal-title">Hapus Rekam Medis</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														<p>Apakah Anda yakin ingin menghapus rekam medis untuk pet
															<strong>{{ $rekam->pet->nama }}</strong>?
														</p>
														<p class="text-muted"><small>Tanggal:
																@formatDateTime($rekam->created_at)</small></p>
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
										<td colspan="7" class="text-center text-muted">Belum ada data rekam medis</td>
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

@endsection