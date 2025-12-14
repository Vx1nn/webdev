@php
    $activeRoles = [];
    $primaryRole = 'Guest';

    if (Auth::check()) {
        $activeRoles = Auth::user()->getActiveRoles();
        $primaryRole = !empty($activeRoles) ? ucfirst($activeRoles[0]) : 'User';
    }
    
    $hasMultipleRoles = count($activeRoles) > 1;
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

                <!-- Menu Utama untuk Semua Role -->
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

                <!-- Menu Berdasarkan Role (semua ditampilkan) -->
                @foreach($activeRoles as $index => $currentRole)
                    @hasRole($currentRole)
                        <li class="nav-header role-header" data-role="{{ $currentRole }}">
                            {{ strtoupper($currentRole) }}
                            @if($hasMultipleRoles)
                                <span class="badge bg-{{ $index == 0 ? 'primary' : 'info' }} ms-2">
                                    {{ $index == 0 ? 'Primary' : 'Secondary' }}
                                </span>
                            @endif
                        </li>

                        @if($currentRole === 'administrator')
                            <!-- Data Master -->
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
                                    class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
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

                            <!-- Data Transaksional -->
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

                        @elseif($currentRole === 'dokter')
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

                        @elseif($currentRole === 'perawat')
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

                        @elseif($currentRole === 'resepsionis')
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

                        @elseif($currentRole === 'pemilik')
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
                        @endif
                        
                        @if(!$loop->last && count($activeRoles) > 1)
                            <div class="my-3 border-top border-secondary opacity-25"></div>
                        @endif
                    @endhasRole
                @endforeach

            </ul>
        </nav>
    </div>
</aside>

<style>
/* Role Header Styling */
.nav-header.role-header {
    position: relative;
    padding-left: 15px;
    margin-top: 10px;
}

.nav-header.role-header::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 70%;
    background-color: #0d6efd;
    border-radius: 2px;
}

/* Badge Styling */
.nav-header .badge {
    font-size: 0.65rem;
    padding: 2px 6px;
    font-weight: 500;
}

/* Separator between roles */
.border-top {
    margin: 15px 15px;
}

/* Dropdown in brand */
.brand-link .dropdown-toggle {
    padding: 2px 6px;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.brand-link .dropdown-toggle:hover {
    background-color: rgba(255,255,255,0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preserve sidebar scroll position
    const sidebar = document.querySelector('.sidebar-wrapper');
    if (sidebar) {
        const scrollPos = localStorage.getItem('sidebarScrollPos');
        if (scrollPos) {
            sidebar.scrollTop = parseInt(scrollPos);
        }
        sidebar.addEventListener('scroll', function() {
            localStorage.setItem('sidebarScrollPos', sidebar.scrollTop);
        });
    }
});

// Function to scroll to specific role section
function scrollToRole(role) {
    const roleHeader = document.querySelector(`.role-header[data-role="${role}"]`);
    if (roleHeader) {
        const sidebar = document.querySelector('.sidebar-wrapper');
        const offset = roleHeader.offsetTop - sidebar.offsetTop - 20;
        
        sidebar.scrollTo({
            top: offset,
            behavior: 'smooth'
        });
        
        // Add highlight effect
        roleHeader.classList.add('bg-primary', 'bg-opacity-10', 'rounded', 'px-2');
        setTimeout(() => {
            roleHeader.classList.remove('bg-primary', 'bg-opacity-10', 'rounded', 'px-2');
        }, 2000);
    }
}
</script>