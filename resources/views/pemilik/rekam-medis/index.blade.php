@extends('layouts.lte.main')

@section('content')

  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Rekam Medis Pet</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Pemilik</a></li>
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
          <h3 class="card-title mb-0">Riwayat Rekam Medis Pet Saya</h3>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 60px">#</th>
                  <th>Tanggal</th>
                  <th>Pet</th>
                  <th>Dokter Pemeriksa</th>
                  <th>Diagnosa</th>
                  <th style="width: 120px">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($data as $rm)
                  <tr class="align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td>@formatDateTime($rm->created_at)</td>
                    <td>{{ $rm->pet->nama ?? '-' }}</td>
                    <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                    <td>{{ \Str::limit($rm->diagnosa, 50) }}</td>
                    <td>
                      <a href="{{ route('pemilik.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-info">
                        Lihat Detail
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada rekam medis</td>
                  </tr>
                @endforelse
              </tbody>

            </table>
          </div>
        </div>

      </div>

    </div>
  </div>

@endsection
    </dialog>
    </main>

    <script>
        async function openDetail(id) {
            const dialog = document.getElementById('detailDialog');
            document.getElementById('d-body').innerHTML = '<p class="muted">Memuat...</p>';
            dialog.showModal();
            try {
                const res = await fetch(`/dashboard/pemilik/rekam-medis/${id}`);
                if (!res.ok) throw new Error('Tidak ditemukan');
                const json = await res.json();
                document.getElementById('d-title').textContent = `Rekam #${json.id} — ${json.tanggal || ''}`;
                let html = `
                <div class="dialog-grid">
                    <div><strong>Pet</strong><div>${json.pet.nama}</div></div>
                    <div><strong>Pemilik</strong><div>${json.pemilik.nama} (${json.pemilik.no_wa})</div></div>
                    <div><strong>Dokter</strong><div>${json.dokter.nama}</div></div>
                    <div><strong>Anamnesa</strong><div>${json.anamnesa ?? '-'}</div></div>
                    <div><strong>Temuan</strong><div>${json.temuan ?? '-'}</div></div>
                    <div><strong>Diagnosa</strong><div>${json.diagnosa ?? '-'}</div></div>
                </div>
                <hr>
                <h4>Detail Tindakan</h4>
                <ul>
                    ${json.detail.map(d => `<li><strong>${d.kode ?? ''}</strong> — ${d.deskripsi} <small class="muted">[${d.kategori} / ${d.klinis}]</small></li>`).join('')}
                </ul>
            `;
                document.getElementById('d-body').innerHTML = html;
            } catch (e) {
                document.getElementById('d-body').innerHTML = `<p class="muted" style="color:var(--pico-del-color)">${e.message}</p>`;
            }
        }
    </script>
</body>

</html>