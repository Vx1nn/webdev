@extends('layouts.lte.main')

@section('content')

	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">Detail Rekam Medis</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="{{ route('dokter.rekam-medis.index') }}">Rekam Medis</a></li>
						<li class="breadcrumb-item active" aria-current="page">Detail</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="app-content">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-6">
					<div class="card mb-4">
						<div class="card-header bg-primary text-white">
							<h5 class="card-title mb-0">Informasi Pasien</h5>
						</div>
						<div class="card-body">
							<table class="table table-sm table-borderless">
								<tr>
									<th style="width: 150px">Nama Pet</th>
									<td>{{ $rekamMedis->pet->nama ?? '-' }}</td>
								</tr>
								<tr>
									<th>Pemilik</th>
									<td>{{ $rekamMedis->pet->pemilik->user->nama ?? '-' }}</td>
								</tr>
								<tr>
									<th>Ras</th>
									<td>{{ $rekamMedis->pet->rasHewan->nama_ras ?? '-' }}</td>
								</tr>
								<tr>
									<th>Jenis Hewan</th>
									<td>{{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card mb-4">
						<div class="card-header bg-success text-white">
							<h5 class="card-title mb-0">Informasi Pemeriksaan</h5>
						</div>
						<div class="card-body">
							<table class="table table-sm table-borderless">
								<tr>
									<th style="width: 150px">Tanggal</th>
									<td>@formatDateTime($rekamMedis->created_at)</td>
								</tr>
								<tr>
									<th>Dokter Pemeriksa</th>
									<td>{{ $rekamMedis->dokter->user->nama ?? '-' }}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="card mb-4">
				<div class="card-header">
					<h5 class="card-title mb-0">Data Rekam Medis</h5>
				</div>
				<div class="card-body">
					<div class="mb-3">
						<strong>Anamnesa:</strong>
						<p class="mt-1">{{ $rekamMedis->anamnesa }}</p>
					</div>
					<div class="mb-3">
						<strong>Temuan Klinis:</strong>
						<p class="mt-1">{{ $rekamMedis->temuan_klinis }}</p>
					</div>
					<div class="mb-3">
						<strong>Diagnosa:</strong>
						<p class="mt-1">{{ $rekamMedis->diagnosa }}</p>
					</div>
				</div>
			</div>

			<div class="card mb-4">
				<div class="card-header">
					<div class="d-flex w-100 justify-content-between align-items-center">
						<h5 class="card-title mb-0">Detail Tindakan & Terapi</h5>
						<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDetail">
							<i class="bi bi-plus-lg"></i> Tambah Detail
						</button>
					</div>
				</div>

				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover table-striped mb-0">
							<thead class="table-light">
								<tr>
									<th style="width: 60px">#</th>
									<th style="width: 100px">Kode</th>
									<th>Deskripsi Tindakan/Terapi</th>
									<th>Kategori</th>
									<th>Detail Tambahan</th>
									<th style="width: 160px">Aksi</th>
								</tr>
							</thead>

							<tbody>
								@forelse($rekamMedis->detailRekamMedis as $detail)
									<tr class="align-middle">
										<td>{{ $loop->iteration }}</td>
										<td><span class="badge bg-info">{{ $detail->kodeTindakanTerapi->kode ?? '-' }}</span>
										</td>
										<td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}</td>
										<td>{{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
										<td>{{ $detail->detail ?? '-' }}</td>
										<td>
											<button class="btn btn-sm btn-warning" data-bs-toggle="modal"
												data-bs-target="#modalEditDetail{{ $detail->iddetail_rekam_medis }}">
												Edit
											</button>

											<button class="btn btn-sm btn-danger" data-bs-toggle="modal"
												data-bs-target="#modalHapusDetail{{ $detail->iddetail_rekam_medis }}">
												Hapus
											</button>
										</td>
									</tr>

									<!-- Modal Edit -->
									<div class="modal fade" id="modalEditDetail{{ $detail->iddetail_rekam_medis }}"
										tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form method="post"
													action="{{ route('dokter.rekam-medis.detail.edit', [$rekamMedis->idrekam_medis, $detail->iddetail_rekam_medis]) }}">
													@csrf
													<div class="modal-header">
														<h5 class="modal-title">Edit Detail</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														<label class="form-label">Kode Tindakan/Terapi</label>
														<select name="idkode_tindakan_terapi" class="form-select mb-2" required>
															@foreach($kodeTindakan as $kt)
																<option value="{{ $kt->idkode_tindakan_terapi }}" {{ $kt->idkode_tindakan_terapi == $detail->idkode_tindakan_terapi ? 'selected' : '' }}>
																	{{ $kt->kode }} - {{ $kt->deskripsi_tindakan_terapi }}
																</option>
															@endforeach
														</select>

														<label class="form-label">Detail Tambahan</label>
														<textarea name="detail" class="form-control"
															rows="3">{{ $detail->detail }}</textarea>
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

									<!-- Modal Hapus -->
									<div class="modal fade" id="modalHapusDetail{{ $detail->iddetail_rekam_medis }}"
										tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form method="post"
													action="{{ route('dokter.rekam-medis.detail.delete', [$rekamMedis->idrekam_medis, $detail->iddetail_rekam_medis]) }}">
													@csrf
													<div class="modal-header">
														<h5 class="modal-title">Hapus Detail</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														Yakin ingin menghapus detail
														<strong>{{ $detail->kodeTindakanTerapi->kode }}</strong>?
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
										<td colspan="6" class="text-center text-muted">Belum ada detail tindakan/terapi</td>
									</tr>
								@endforelse
							</tbody>

						</table>
					</div>
				</div>

			</div>

		</div>
	</div>

	<!-- Modal Tambah Detail -->
	<div class="modal fade" id="modalTambahDetail" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="post" action="{{ route('dokter.rekam-medis.detail.store', $rekamMedis->idrekam_medis) }}">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title">Tambah Detail Tindakan/Terapi</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<label class="form-label">Kode Tindakan/Terapi</label>
						<select name="idkode_tindakan_terapi" class="form-select mb-2" required>
							<option value="">-- Pilih --</option>
							@foreach($kodeTindakan as $kt)
								<option value="{{ $kt->idkode_tindakan_terapi }}">
									{{ $kt->kode }} - {{ $kt->deskripsi_tindakan_terapi }}
								</option>
							@endforeach
						</select>

						<label class="form-label">Detail Tambahan</label>
						<textarea name="detail" class="form-control" rows="3"
							placeholder="Catatan tambahan (opsional)"></textarea>
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