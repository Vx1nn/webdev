@php
    $activeRoles = [];
    $primaryRole = 'Guest';

    if (Auth::check()) {
        $activeRoles = Auth::user()->getActiveRoles();
        $primaryRole = !empty($activeRoles) ? ucfirst($activeRoles[0]) : 'User';
    }
@endphp

<aside class="app-sidebar bg-black" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img
                src="{{ asset('assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light">RSHP - {{ $primaryRole }}</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false">

                <li class="nav-header">MENU UTAMA</li>
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ request()->is('/') || request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house-fill"></i>
                        <p>Beranda</p>
                    </a>
                </li>

                @if (!empty($activeRoles))
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif

                @hasRole('administrator')
                    <li class="nav-header">ADMINISTRATOR</li>


                    <li class="nav-header small text-muted py-1">DATA MASTER</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}"
                            class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.role.index') }}"
                            class="nav-link {{ request()->is('admin/role*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Role</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pet.index') }}"
                            class="nav-link {{ request()->is('admin/pet*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-paw"></i>
                            <p>Hewan Peliharaan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.jenis-hewan.index') }}"
                            class="nav-link {{ request()->is('admin/jenis-hewan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dog"></i>
                            <p>Jenis Hewan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ras-hewan.index') }}"
                            class="nav-link {{ request()->is('admin/ras-hewan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cat"></i>
                            <p>Ras Hewan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kategori.index') }}"
                            class="nav-link {{ request()->is('admin/kategori') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kategori-klinis.index') }}"
                            class="nav-link {{ request()->is('admin/kategori-klinis*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>Kategori Klinis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kode-tindakan.index') }}"
                            class="nav-link {{ request()->is('admin/kode-tindakan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-medical"></i>
                            <p>Kode Tindakan</p>
                        </a>
                    </li>

                    <li class="nav-header small text-muted py-1 mt-2">DATA TRANSAKSIONAL</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.pemilik.index') }}"
                            class="nav-link {{ request()->is('admin/pemilik*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Pemilik</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dokter.index') }}"
                            class="nav-link {{ request()->is('admin/dokter*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.perawat.index') }}"
                            class="nav-link {{ request()->is('admin/perawat*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-nurse"></i>
                            <p>Perawat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.rekam-medis.index') }}"
                            class="nav-link {{ request()->is('admin/rekam-medis*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.temu-dokter.index') }}"
                            class="nav-link {{ request()->is('admin/temu-dokter*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Temu Dokter</p>
                        </a>
                    </li>
                @endhasRole

                @hasRole('dokter')
                    <li class="nav-header">DOKTER</li>

                    <li class="nav-item">
                        <a href="{{ route('dokter.rekam-medis.index') }}"
                            class="nav-link {{ request()->is('dokter/rekam-medis*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('dokter.pasien.index') }}"
                            class="nav-link {{ request()->is('dokter/pasien*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-procedures"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                @endhasRole

                @hasRole('perawat')
                    <li class="nav-header">PERAWAT</li>

                    <li class="nav-item">
                        <a href="{{ route('perawat.rekam-medis.index') }}"
                            class="nav-link {{ request()->is('perawat/rekam-medis*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('perawat.pasien.index') }}"
                            class="nav-link {{ request()->is('perawat/pasien*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-procedures"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                @endhasRole

                @hasRole('resepsionis')
                    <li class="nav-header">RESEPSIONIS</li>

                    <li class="nav-item">
                        <a href="{{ route('resepsionis.pemilik.index') }}"
                            class="nav-link {{ request()->is('resepsionis/pemilik*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Data Pemilik</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('resepsionis.pet.index') }}"
                            class="nav-link {{ request()->is('resepsionis/pet*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-paw"></i>
                            <p>Data Hewan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('resepsionis.temu-dokter.index') }}"
                            class="nav-link {{ request()->is('resepsionis/temu-dokter*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-plus"></i>
                            <p>Temu Dokter</p>
                        </a>
                    </li>
                @endhasRole

                @hasRole('pemilik')
                    <li class="nav-header">PEMILIK</li>

                    <li class="nav-item">
                        <a href="{{ route('pemilik.pet.index') }}"
                            class="nav-link {{ request()->is('pemilik/pet*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-paw"></i>
                            <p>Hewan Peliharaan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pemilik.rekam-medis.index') }}"
                            class="nav-link {{ request()->is('pemilik/rekam-medis*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pemilik.temu-dokter.index') }}"
                            class="nav-link {{ request()->is('pemilik/temu-dokter*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Reservasi</p>
                        </a>
                    </li>
                @endhasRole

            </ul>
        </nav>
    </div>
</aside>

<script>
    // Preserve sidebar scroll position
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar-wrapper');
        if (sidebar) {
            // Restore scroll position
            const scrollPos = localStorage.getItem('sidebarScrollPos');
            if (scrollPos) {
                sidebar.scrollTop = parseInt(scrollPos);
            }

            // Save scroll position on scroll
            sidebar.addEventListener('scroll', function() {
                localStorage.setItem('sidebarScrollPos', sidebar.scrollTop);
            });
        }
    });
</script>