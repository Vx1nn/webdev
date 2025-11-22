@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<h3 class="mb-0">Profil Saya</h3>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-end">
					<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Profil</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="app-content">
	<div class="container-fluid">

		<div class="row">
			<!-- User Info Card -->
			<div class="col-md-4">
				<div class="card mb-4">
					<div class="card-body text-center">
						<div class="mb-3">
							@php
								$avatarColor = match(true) {
									isset($profiles['dokter']) => '#007bff',
									isset($profiles['perawat']) => '#28a745', 
									isset($profiles['administrator']) => '#dc3545',
									isset($profiles['resepsionis']) => '#ffc107',
									isset($profiles['pemilik']) => '#17a2b8',
									default => '#667eea'
								};
							@endphp
							<i class="bi bi-person-circle" style="font-size: 100px; color: {{ $avatarColor }};"></i>
						</div>
						<h4>{{ $user->nama }}</h4>
						<p class="text-muted mb-3">{{ $user->email }}</p>
						<div class="d-flex flex-wrap gap-1 justify-content-center">
							@foreach($activeRoles as $role)
								@php
									$badgeColor = match($role) {
										'administrator' => 'bg-danger',
										'dokter' => 'bg-primary',
										'perawat' => 'bg-success',
										'resepsionis' => 'bg-warning text-dark',
										'pemilik' => 'bg-info',
										default => 'bg-secondary'
									};
								@endphp
								<span class="badge {{ $badgeColor }}">{{ ucfirst($role) }}</span>
							@endforeach
						</div>
					</div>
				</div>

				<!-- Quick Actions -->
				<div class="card">
					<div class="card-header">
						<h6 class="card-title mb-0"><i class="fas fa-cog me-2"></i>Aksi Cepat</h6>
					</div>
					<div class="card-body">
						<div class="d-grid gap-2">
							<a href="#" class="btn btn-outline-primary">
								<i class="fas fa-edit me-2"></i>Edit Profil
							</a>
							<a href="#" class="btn btn-outline-warning">
								<i class="fas fa-key me-2"></i>Ubah Password
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Profile Details -->
			<div class="col-md-8">
				<!-- Basic Account Info -->
				<div class="card mb-4">
					<div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
						<h5 class="card-title mb-0"><i class="fas fa-user me-2"></i>Informasi Akun Dasar</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<table class="table table-borderless">
									<tr>
										<th style="width: 150px">Nama Lengkap</th>
										<td>{{ $user->nama }}</td>
									</tr>
									<tr>
										<th>Email</th>
										<td>{{ $user->email }}</td>
									</tr>
									<tr>
										<th>Tahun Bergabung</th>
										<td>2025</td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table class="table table-borderless">
									<tr>
										<th style="width: 150px">Role Aktif</th>
										<td>
											@foreach($activeRoles as $role)
												@php
													$badgeColor = match($role) {
														'administrator' => 'bg-danger',
														'dokter' => 'bg-primary',
														'perawat' => 'bg-success',
														'resepsionis' => 'bg-warning text-dark',
														'pemilik' => 'bg-info',
														default => 'bg-secondary'
													};
												@endphp
												<span class="badge {{ $badgeColor }} me-1">{{ ucfirst($role) }}</span>
											@endforeach
										</td>
									</tr>
									<tr>
										<th>Status Akun</th>
										<td>
											<span class="badge bg-success">
												<i class="fas fa-check me-1"></i>Aktif
											</span>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>

				<!-- Administrator Profile -->
				@if(isset($profiles['administrator']))
					<div class="card mb-4">
						<div class="card-header bg-gradient bg-danger text-white">
							<h5 class="card-title mb-0"><i class="fas fa-user-shield me-2"></i>Detail Administrator</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Role Sistem</th>
											<td>Administrator</td>
										</tr>
										<tr>
											<th>Level Akses</th>
											<td>Full System Access</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Status</th>
											<td>
												@if($profiles['administrator']['roleUser'] && $profiles['administrator']['roleUser']->status == 1)
													<span class="badge bg-success"><i class="fas fa-check me-1"></i>Aktif</span>
												@else
													<span class="badge bg-danger"><i class="fas fa-times me-1"></i>Nonaktif</span>
												@endif
											</td>
										</tr>
										<tr>
											<th>Hak Akses</th>
											<td>Super User</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				@endif

				<!-- Dokter Profile -->
				@if(isset($profiles['dokter']) && $profiles['dokter']['data'])
					<div class="card mb-4">
						<div class="card-header bg-gradient bg-primary text-white">
							<h5 class="card-title mb-0"><i class="fas fa-user-md me-2"></i>Detail Dokter</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Bidang Spesialisasi</th>
											<td>{{ $profiles['dokter']['data']->bidang_dokter ?? 'Tidak ditentukan' }}</td>
										</tr>
										<tr>
											<th>No. Telepon</th>
											<td>
												@if($profiles['dokter']['data']->no_hp)
													<a href="tel:{{ $profiles['dokter']['data']->no_hp }}" class="text-decoration-none">
														{{ $profiles['dokter']['data']->no_hp }}
													</a>
												@else
													-
												@endif
											</td>
										</tr>
										<tr>
											<th>Jenis Kelamin</th>
											<td>
												@if($profiles['dokter']['data']->jenis_kelamin == 'L')
													Laki-laki
												@elseif($profiles['dokter']['data']->jenis_kelamin == 'P')
													Perempuan
												@else
													Tidak ditentukan
												@endif
											</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Status</th>
											<td>
												@if($profiles['dokter']['roleUser'] && $profiles['dokter']['roleUser']->status == 1)
													<span class="badge bg-success"><i class="fas fa-check me-1"></i>Aktif</span>
												@else
													<span class="badge bg-danger"><i class="fas fa-times me-1"></i>Nonaktif</span>
												@endif
											</td>
										</tr>
										<tr>
											<th>Alamat</th>
											<td>{{ $profiles['dokter']['data']->alamat ?? 'Tidak ada alamat' }}</td>
										</tr>
										<tr>
											<th>ID Dokter</th>
											<td>#{{ $profiles['dokter']['data']->id_dokter }}</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				@endif

				<!-- Perawat Profile -->
				@if(isset($profiles['perawat']) && $profiles['perawat']['data'])
					<div class="card mb-4">
						<div class="card-header bg-gradient bg-success text-white">
							<h5 class="card-title mb-0"><i class="fas fa-user-nurse me-2"></i>Detail Perawat</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Pendidikan</th>
											<td>{{ $profiles['perawat']['data']->pendidikan ?? 'Tidak ditentukan' }}</td>
										</tr>
										<tr>
											<th>No. Telepon</th>
											<td>
												@if($profiles['perawat']['data']->no_hp)
													<a href="tel:{{ $profiles['perawat']['data']->no_hp }}" class="text-decoration-none">
														{{ $profiles['perawat']['data']->no_hp }}
													</a>
												@else
													-
												@endif
											</td>
										</tr>
										<tr>
											<th>Jenis Kelamin</th>
											<td>
												@if($profiles['perawat']['data']->jenis_kelamin == 'L')
													Laki-laki
												@elseif($profiles['perawat']['data']->jenis_kelamin == 'P')
													Perempuan
												@else
													Tidak ditentukan
												@endif
											</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Status</th>
											<td>
												@if($profiles['perawat']['roleUser'] && $profiles['perawat']['roleUser']->status == 1)
													<span class="badge bg-success"><i class="fas fa-check me-1"></i>Aktif</span>
												@else
													<span class="badge bg-danger"><i class="fas fa-times me-1"></i>Nonaktif</span>
												@endif
											</td>
										</tr>
										<tr>
											<th>Alamat</th>
											<td>{{ $profiles['perawat']['data']->alamat ?? 'Tidak ada alamat' }}</td>
										</tr>
										<tr>
											<th>ID Perawat</th>
											<td>#{{ $profiles['perawat']['data']->id_perawat }}</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				@endif

				<!-- Resepsionis Profile -->
				@if(isset($profiles['resepsionis']))
					<div class="card mb-4">
						<div class="card-header bg-gradient bg-warning text-dark">
							<h5 class="card-title mb-0"><i class="fas fa-user-tie me-2"></i>Detail Resepsionis</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Posisi</th>
											<td>Front Desk Officer</td>
										</tr>
										<tr>
											<th>Departemen</th>
											<td>Customer Service</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Status</th>
											<td>
												@if($profiles['resepsionis']['roleUser'] && $profiles['resepsionis']['roleUser']->status == 1)
													<span class="badge bg-success"><i class="fas fa-check me-1"></i>Aktif</span>
												@else
													<span class="badge bg-danger"><i class="fas fa-times me-1"></i>Nonaktif</span>
												@endif
											</td>
										</tr>
										<tr>
											<th>Tugas</th>
											<td>Registrasi Pasien & Appointment</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				@endif

				<!-- Pemilik Profile -->
				@if(isset($profiles['pemilik']) && $profiles['pemilik']['data'])
					<div class="card mb-4">
						<div class="card-header bg-gradient bg-info text-white">
							<h5 class="card-title mb-0"><i class="fas fa-paw me-2"></i>Detail Pemilik Hewan</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">No. WhatsApp</th>
											<td>
												@if($profiles['pemilik']['data']->no_wa)
													<a href="https://wa.me/{{ $profiles['pemilik']['data']->no_wa }}" 
													   target="_blank" class="text-decoration-none">
														{{ $profiles['pemilik']['data']->no_wa }}
														<i class="fab fa-whatsapp ms-1 text-success"></i>
													</a>
												@else
													-
												@endif
											</td>
										</tr>
										<tr>
											<th>ID Pemilik</th>
											<td>#{{ $profiles['pemilik']['data']->id_pemilik }}</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<th style="width: 150px">Status</th>
											<td>
												@if($profiles['pemilik']['roleUser'] && $profiles['pemilik']['roleUser']->status == 1)
													<span class="badge bg-success"><i class="fas fa-check me-1"></i>Aktif</span>
												@else
													<span class="badge bg-danger"><i class="fas fa-times me-1"></i>Nonaktif</span>
												@endif
											</td>
										</tr>
										<tr>
											<th>Alamat</th>
											<td>
												@if($profiles['pemilik']['data']->alamat)
													{{ $profiles['pemilik']['data']->alamat }}
												@else
													<span class="text-muted">Tidak ada alamat</span>
												@endif
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				@endif

			</div>
		</div>

	</div>
</div>

@endsection

@push('styles')
<style>
	.card {
		border: none;
		box-shadow: 0 2px 10px rgba(0,0,0,0.08);
		border-radius: 10px;
	}

	.card-header {
		border-radius: 10px 10px 0 0 !important;
		border: none;
	}

	.table-borderless th {
		font-weight: 600;
		color: #495057;
	}

	.badge {
		font-size: 0.75em;
		padding: 0.5em 0.75em;
	}

	.bi-person-circle {
		transition: transform 0.3s ease;
	}

	.bi-person-circle:hover {
		transform: scale(1.1);
	}
</style>
@endpush