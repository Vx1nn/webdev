@include('layouts.lte.navbar')

<!doctype html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="assets/css/pico.yellow.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Dashboard Resepsionis - RSHP UNAIR</title>
</head>
<body>
    <main class="container">
        <section class="hero">
            <div class="center-row">
                <h1>Welcome</h1>
                <p class="lead">Anda sekarang berada di dashboard Resepsionis.</p>
            </div>
        </section>

        <!-- Grid Menu -->
        <section class="services-grid" aria-label="Menu Dokter - Grid">
            <article class="service-card" aria-labelledby="m-rekammedis">
                <h4 id="m-pemilik">Data Pemilik</h4>
                <p class="short">Nama, alamat, dan nomor kontak pemilik hewan.</p>
                <small class="muted"><a href="resepsionis/pemilik">Lihat Data</a></small>
            </article>

            <article class="service-card" aria-labelledby="m-rekammedis">
                <h4 id="m-pet">Data Hewan</h4>
                <p class="short">Informasi ras, jenis, dan pemilik hewan.</p>
                <small class="muted"><a href="resepsionis/pets">Lihat Data</a></small>
            </article>

            <article class="service-card" aria-labelledby="m-rekammedis">
                <h4 id="m-temu-dokter">Temu Dokter</h4>
                <p class="short">Data registrasi dan jadwal temu dokter.</p>
                <small class="muted"><a href="resepsionis/temu-dokter">Lihat Data</a></small>
            </article>
        </section>
    </main>
</body>
</html>