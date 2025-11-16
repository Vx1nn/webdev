@include('layouts.lte.navbar')

<!doctype html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="assets/css/pico.yellow.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Dashboard Pemilik - RSHP UNAIR</title>
</head>
<body>
    <main class="container">
        <section class="hero">
            <div class="center-row">
                <h1>Welcome</h1>
                <p class="lead">Anda sekarang berada di dashboard Pemilik.</p>
            </div>
        </section>

        <!-- Grid Menu -->
        <section class="services-grid" aria-label="Menu Perawat - Grid">
            <article class="service-card" aria-labelledby="m-pets">
                <h4 id="m-pet">Hewan Peliharaan</h4>
                <p class="short">Daftar hewan yang saya daftarkan di RSHP.</p>
                <small class="muted"><a href="pemilik/pets">Lihat Data</a></small>
            </article>

            <article class="service-card" aria-labelledby="m-rekammedis">
                <h4 id="m-rekam-medis">Rekam Medis Saya</h4>
                <p class="short">Riwayat pemeriksaan hewan milik saya.</p>
                <small class="muted"><a href="pemilik/rekam-medis">Lihat Data</a></small>
            </article>

            <article class="service-card" aria-labelledby="m-reservasi">
                <h4 id="m-reservasi">Reservasi</h4>
                <p class="short">Jadwal dan status pertemuan dengan dokter.</p>
                <small class="muted"><a href="pemilik/reservasi">Lihat Data</a></small>
            </article>
        </section>

        
    </main>
</body>
</html>