@include('layouts.lte.navbar')

<!doctype html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="assets/css/pico.yellow.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Rekam Medis - Perawat Dashboard</title>
</head>

<body>
    <main class="container">
        <section class="hero">
            <div class="center-row">
                <h1>Rekam Medis</h1>
            </div>
        </section>
        <table role="grid">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pet</th>
                    <th>Pemilik</th>
                    <th>Dokter</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekam as $r)
                    <tr>
                        <td>{{ $r->created_at }}</td>
                        <td>{{ $r->pet->nama ?? '-' }}</td>
                        <td>{{ $r->pet->pemilik->user->nama ?? '-' }}</td>
                        <td>{{ $r->dokter->user->nama ?? '-' }}</td>
                        <td><a href="#" onclick="openDetail({{ $r->idrekam_medis }})">Lihat</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <dialog id="detailDialog">
            <div class="dialog-card">
                <button style="float:right" onclick="document.getElementById('detailDialog').close()">✕</button>
                <h3 id="d-title">Detail Rekam</h3>
                <div id="d-body">
                    <p class="muted">Memuat...</p>
                </div>
            </div>
        </dialog>
    </main>

    <script>
        async function openDetail(id) {
            const dialog = document.getElementById('detailDialog');
            document.getElementById('d-body').innerHTML = '<p class="muted">Memuat...</p>';
            dialog.showModal();
            try {
                const res = await fetch(`/dashboard/perawat/rekam-medis/${id}`);
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