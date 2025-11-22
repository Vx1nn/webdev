@extends('layouts.lte.main')

@section('content')

	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">Rekam Medis</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="#">Dokter</a></li>
						<li class="breadcrumb-item active" aria-current="page">Rekam Medis</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="app-content">
		<div class="container-fluid">

			<div class="card mb-4">
				<div class="card-header">
					<h3 class="card-title mb-0">Daftar Rekam Medis</h3>
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
									<th>Dokter Pemeriksa</th>
									<th>Diagnosa</th>
									<th style="width: 120px">Aksi</th>
								</tr>
							</thead>

							<tbody>
								@foreach($data as $rm)
									<tr class="align-middle">
										<td>{{ $loop->iteration }}</td>
										<td>@formatDateTime($rm->created_at)</td>
										<td>{{ $rm->pet->nama ?? '-' }}</td>
										<td>{{ $rm->pet->pemilik->user->nama ?? '-' }}</td>
										<td>{{ $rm->dokter->user->nama ?? '-' }}</td>
										<td>{{ \Str::limit($rm->diagnosa, 50) }}</td>
										<td>
											<a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}"
												class="btn btn-sm btn-info">
												Lihat Detail
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>

						</table>
					</div>
				</div>

			</div>

		</div>
	</div>

@endsection