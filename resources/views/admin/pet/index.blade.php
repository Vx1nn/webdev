@extends('layouts.lte.main')

@section('content')

	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">Pet</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="#">Data Master</a></li>
						<li class="breadcrumb-item active" aria-current="page">Pet</li>
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
						<h3 class="card-title mb-0">Daftar Pet</h3>

						<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPet">
							<i class="bi bi-plus-lg"></i> Tambah Pet
						</button>
					</div>
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
									<th style="width: 160px">Aksi</th>
								</tr>
							</thead>

							<tbody>
								@foreach($data as $pet)
									<tr class="align-middle">
										<td>{{ $loop->iteration }}</td>
										<td>{{ $pet->nama }}</td>
										<td>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : ($pet->jenis_kelamin == 'B' ? 'Betina' : '-') }}
										</td>
										<td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
										<td>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
										<td>{{ $pet->pemilik->user->nama ?? '-' }}</td>

										<td>
											<button class="btn btn-sm btn-warning" data-bs-toggle="modal"
												data-bs-target="#modalEditPet{{ $pet->idpet }}">
												Edit
											</button>

											<button class="btn btn-sm btn-danger" data-bs-toggle="modal"
												data-bs-target="#modalHapusPet{{ $pet->idpet }}">
												Hapus
											</button>
										</td>
									</tr>

									<div class="modal fade" id="modalEditPet{{ $pet->idpet }}" tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form method="post" action="{{ route('admin.pet.edit', $pet->idpet) }}">
													@csrf

													<div class="modal-header">
														<h5 class="modal-title">Edit Pet</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>

													<div class="modal-body">
														<label class="form-label">Nama Pet</label>
														<input name="nama" class="form-control mb-2" value="{{ $pet->nama }}">

														<label class="form-label">Jenis Kelamin</label>
														<select name="jenis_kelamin" class="form-select mb-2">
															<option value="J" {{ $pet->jenis_kelamin == 'J' ? 'selected' : '' }}>
																Jantan</option>
															<option value="B" {{ $pet->jenis_kelamin == 'B' ? 'selected' : '' }}>
																Betina</option>
														</select>

														<label class="form-label">Ras</label>
														<select name="idras_hewan" class="form-select mb-2">
															@foreach($ras as $r)
																<option value="{{ $r->idras_hewan }}" {{ $r->idras_hewan == $pet->idras_hewan ? 'selected' : '' }}>
																	{{ $r->nama_ras }}
																</option>
															@endforeach
														</select>

														<label class="form-label">Pemilik</label>
														<select name="idpemilik" class="form-select mb-2">
															@foreach($pemilik as $p)
																<option value="{{ $p->idpemilik }}" {{ $p->idpemilik == $pet->idpemilik ? 'selected' : '' }}>
																	{{ $p->user->nama }}
																</option>
															@endforeach
														</select>

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

									<div class="modal fade" id="modalHapusPet{{ $pet->idpet }}" tabindex="-1">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<form method="post" action="{{ route('admin.pet.delete', $pet->idpet) }}">
													@csrf

													<div class="modal-header">
														<h5 class="modal-title">Hapus Pet</h5>
														<button type="button" class="btn-close"
															data-bs-dismiss="modal"></button>
													</div>

													<div class="modal-body">
														Yakin ingin menghapus pet <strong>{{ $pet->nama }}</strong>?
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

	<div class="modal fade" id="modalTambahPet" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="post" action="{{ route('admin.pet.store') }}">
					@csrf

					<div class="modal-header">
						<h5 class="modal-title">Tambah Pet</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
						<x-validation-errors />
						<label class="form-label">Nama Pet</label>
						<input name="nama" class="form-control mb-2">

						<label class="form-label">Jenis Kelamin</label>
						<select name="jenis_kelamin" class="form-select mb-2">
							<option value="J">Jantan</option>
							<option value="B">Betina</option>
						</select>

						<label class="form-label">Ras</label>
						<select name="idras_hewan" class="form-select mb-2" id="selectRas">
							@foreach($ras as $r)
								<option value="{{ $r->idras_hewan }}" data-jenis="{{ $r->jenisHewan->nama_jenis_hewan ?? '' }}">
									{{ $r->nama_ras }}
								</option>
							@endforeach
						</select>

						<label class="form-label">Jenis Hewan</label>
						<input id="inputJenisHewan" class="form-control mb-2" disabled>

						<label class="form-label">Pemilik</label>
						<select name="idpemilik" class="form-select mb-2">
							@foreach($pemilik as $p)
								<option value="{{ $p->idpemilik }}">{{ $p->user->nama }}</option>
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

	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const rasSelect = document.getElementById('selectRas')
			const jenisInput = document.getElementById('inputJenisHewan')
			function updateJenis() {
				const opt = rasSelect.options[rasSelect.selectedIndex]
				jenisInput.value = opt.dataset.jenis || '-'
			}
			rasSelect.addEventListener('change', updateJenis)
			updateJenis()
		})
	</script>

@endsection