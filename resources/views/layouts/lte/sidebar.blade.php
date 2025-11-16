<aside class="app-sidebar bg-black" data-bs-theme="dark">
  <div class="sidebar-brand">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img
        src="{{ asset('assets/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
    <span class="brand-text fw-light">RSHP - AdminLTE</span>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation"
        data-accordion="false" id="navigation">

        <li class="nav-header">MAIN PAGES</li>
        <li class="nav-item" aria-label="Home Page">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon bi bi-house-fill"></i>
            <p>Home Page</p>
          </a>
        </li>
        <li class="nav-item" aria-label="Dashboard">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">DATA MASTER</li>
        <li class="nav-item" aria-label="User">
          <a href="{{ route('admin.user.index') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i> <p>User</p>
          </a>
        </li>
        <li class="nav-item" aria-label="Role">
          <a href="{{ route('admin.role.index') }}" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>Role</p>
          </a>
        </li>
        <li class="nav-item" aria-label="Pet">
          <a href="{{ route('admin.pet.index') }}" class="nav-link">
            <i class="nav-icon fas fa-paw"></i> <p>Pet</p>
          </a>
        </li>
        <li class="nav-item" aria-label="Jenis Hewan">
          <a href="{{ route('admin.jenis-hewan.index') }}" class="nav-link">
            <i class="nav-icon fas fa-dog"></i> <p>Jenis Hewan</p>
          </a>
        </li>
        <li class="nav-item" aria-label="Ras Hewan">
          <a href="{{ route('admin.ras-hewan.index') }}" class="nav-link">
            <i class="nav-icon fas fa-cat"></i> <p>Ras Hewan</p>
          </a>
        </li>
        <li class="nav-item" aria-label="Kategori">
          <a href="{{ route('admin.kategori.index') }}" class="nav-link">
            <i class="nav-icon fas fa-tags"></i> <p>Kategori</p>
          </a>
        </li>
        <li class="nav-item" aria-label="Kategori Klinis">
          <a href="{{ route('admin.kategori-klinis.index') }}" class="nav-link">
            <i class="nav-icon fas fa-stethoscope"></i> <p>Kategori Klinis</p>
          </a>
        </li>
        <li class="nav-item" aria-label="Kode Tindakan Terapi">
          <a href="{{ route('admin.kode-tindakan.index') }}" class="nav-link">
            <i class="nav-icon fas fa-file-medical"></i>
            <p>Kode Tindakan Terapi</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>