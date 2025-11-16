@extends('layouts.lte.main')

@section('content')
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Dashboard</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <h5 class="mb-2">Data Master</h5>
      <div class="row">

        <!-- User -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner text-white">
              <h4><strong>User</strong></h4>
              <p>Manajemen user & akses</p>
            </div>
            <a href="{{ route('admin.user.index') }}"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Data <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>

        <!-- Role -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner text-white">
              <h4><strong>Role</strong></h4>
              <p>Peran pengguna RSHP</p>
            </div>
            <a href="{{ route('admin.role.index') }}"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Data <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>

        <!-- Pet -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h4><strong>Pet</strong></h4>
              <p>Data hewan peliharaan</p>
            </div>
            <a href="{{ route('admin.pet.index') }}"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Data <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>

        <!-- Jenis Hewan -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4><strong>Jenis Hewan</strong></h4>
              <p>List jenis hewan</p>
            </div>
            <a href="{{ route('admin.jenis-hewan.index') }}"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Data <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>

        <!-- Ras Hewan -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner text-white">
              <h4><strong>Ras Hewan</strong></h4>
              <p>Kategori ras berdasarkan jenis</p>
            </div>
            <a href="{{ route('admin.ras-hewan.index') }}"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Data <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>

        <!-- Kategori -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-secondary">
            <div class="inner text-white">
              <h4><strong>Kategori</strong></h4>
              <p>Kategori tindakan klinis</p>
            </div>
            <a href="{{ route('admin.kategori.index') }}"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Data <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>

        <!-- Kategori Klinis -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-dark">
            <div class="inner text-white">
              <h4><strong>Kategori Klinis</strong></h4>
              <p>Klasifikasi terapi / tindakan</p>
            </div>
            <a href="{{ route('admin.kategori-klinis.index') }}"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Data <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>

        <!-- Kode Tindakan -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner text-white">
              <h4><strong>Kode Tindakan</strong></h4>
              <p>Kode & deskripsi tindakan</p>
            </div>
            <a href="{{ route('admin.kode-tindakan.index') }}"
              class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Data <i class="bi bi-link-45deg"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>

  </main>
@endsection
