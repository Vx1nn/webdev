@extends('layouts.lte.main')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
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
                        <h3 class="card-title mb-0">Daftar User</h3>

                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                            <i class="bi bi-plus-lg"></i> Tambah User
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th style="width: 160px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $user)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $r)
                                                <span
                                                    class="badge bg-{{ $r->pivot->status ? 'success' : 'danger' }} me-1 mb-1">
                                                    {{ $r->nama_role }}
                                                    @if ($r->pivot->status)
                                                        <i class="fas fa-check-circle"></i>
                                                    @else
                                                        <i class="fas fa-times-circle"></i>
                                                    @endif
                                                </span>
                                            @endforeach
                                            @if ($user->roles->isEmpty())
                                                <span class="text-muted">Tidak ada role</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modalEditUser{{ $user->iduser }}">
                                                Edit
                                            </button>

                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalHapusUser{{ $user->iduser }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modalEditUser{{ $user->iduser }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form method="post" action="{{ route('admin.user.edit', $user->iduser) }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit User</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <label class="form-label">Nama</label>
                                                        <input name="nama" class="form-control mb-2"
                                                            value="{{ $user->nama }}">

                                                        <label class="form-label">Email</label>
                                                        <input name="email" class="form-control mb-2"
                                                            value="{{ $user->email }}">

                                                        <label class="form-label">Role & Status</label>
                                                        <div class="border rounded p-3 mb-2">
                                                            @foreach ($roles as $r)
                                                                @php
                                                                    $userRole = $user->roles->firstWhere(
                                                                        'idrole',
                                                                        $r->idrole,
                                                                    );
                                                                    $isAssigned = $userRole !== null;
                                                                    $isActive = $isAssigned && $userRole->pivot->status;
                                                                @endphp
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-3">
                                                                    <div>
                                                                        <div class="form-check form-check-inline mb-0">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="roles[{{ $r->idrole }}][assigned]"
                                                                                id="role_{{ $r->idrole }}_{{ $user->iduser }}"
                                                                                value="1"
                                                                                {{ $isAssigned ? 'checked' : '' }}
                                                                                onchange="toggleRoleStatus(this, 'switch_{{ $r->idrole }}_{{ $user->iduser }}')">
                                                                            <label class="form-check-label"
                                                                                for="role_{{ $r->idrole }}_{{ $user->iduser }}">
                                                                                <strong>{{ $r->nama_role }}</strong>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check form-switch">
                                                                        <input type="hidden" name="roles[{{ $r->idrole }}][status]" value="0">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            role="switch"
                                                                            name="roles[{{ $r->idrole }}][status]"
                                                                            id="switch_{{ $r->idrole }}_{{ $user->iduser }}"
                                                                            value="1" {{ $isActive ? 'checked' : '' }}
                                                                            {{ !$isAssigned ? 'disabled' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="switch_{{ $r->idrole }}_{{ $user->iduser }}">
                                                                            <small class="text-muted">Status</small>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <p class="text-muted small mb-0">Centang role untuk menetapkan,
                                                            gunakan toggle untuk mengaktifkan/nonaktifkan.</p>

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

                                    <div class="modal fade" id="modalHapusUser{{ $user->iduser }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form method="post"
                                                    action="{{ route('admin.user.delete', $user->iduser) }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus User</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p>Yakin ingin menghapus user <strong>{{ $user->nama }}</strong>?
                                                        </p>
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

    <div class="modal fade" id="modalTambahUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('admin.user.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Nama</label>
                        <input name="nama" class="form-control mb-2" required>

                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control mb-2" required>

                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control mb-3" required>

                        <label class="form-label">Role & Status</label>
                        <div class="border rounded p-3">
                            @foreach ($roles as $r)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="checkbox"
                                                name="roles[{{ $r->idrole }}][assigned]"
                                                id="role_create_{{ $r->idrole }}" value="1"
                                                onchange="toggleRoleStatus(this, 'switch_create_{{ $r->idrole }}')">
                                            <label class="form-check-label" for="role_create_{{ $r->idrole }}">
                                                <strong>{{ $r->nama_role }}</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="roles[{{ $r->idrole }}][status]" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="roles[{{ $r->idrole }}][status]"
                                            id="switch_create_{{ $r->idrole }}" value="1" checked disabled>
                                        <label class="form-check-label" for="switch_create_{{ $r->idrole }}">
                                            <small class="text-muted">Status</small>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-muted small mt-2 mb-0">Centang role untuk menetapkan, gunakan toggle untuk
                            mengaktifkan/nonaktifkan.</p>
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
        function toggleRoleStatus(checkbox, switchId) {
            const statusSwitch = document.getElementById(switchId);
            statusSwitch.disabled = !checkbox.checked;
            if (!checkbox.checked) {
                statusSwitch.checked = false;
            } else {
                statusSwitch.checked = true;
            }
        }
    </script>
@endsection
