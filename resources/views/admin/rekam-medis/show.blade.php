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
						<li class="breadcrumb-item"><a href="{{ route('admin.rekam-medis.index') }}">Rekam Medis</a></li>
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
							<h5 class="card-title mb-0">Informasi Pet</h5>
						</div>
						<div class="card-body">
							<table class="table table-sm table-borderless">
								<tr>
									<th style="width: 150px">Nama Pet</th>
									<td>{{ $rekamMedis->pet->nama ?? '-' }}</td>
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
					<h5 class="card-title mb-0">Hasil Pemeriksaan</h5>
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
					<h5 class="card-title mb-0">Tindakan & Terapi yang Diberikan</h5>
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
									<th>Keterangan</th>
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
									</tr>
								@empty
									<tr>
										<td colspan="5" class="text-center text-muted">Tidak ada detail tindakan/terapi</td>
									</tr>
								@endforelse
							</tbody>

						</table>
					</div>
				</div>

			</div>

			<div class="mb-3">
				<a href="{{ route('pemilik.rekam-medis.index') }}" class="btn btn-secondary">
					<i class="bi bi-arrow-left"></i> Kembali
				</a>
			</div>

		</div>
	</div>

@endsection