@include('layouts.lte.navbar')

<!doctype html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="assets/css/pico.yellow.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Dashboard Admin - RSHP UNAIR</title>
</head>

<body>
    <main class="container">
        <section class="hero">
            <div class="center-row">
                <h1>Welcome</h1>
                <p class="lead">Anda sekarang berada di dashboard Perawat.</p>
            </div>
        </section>

        <!-- Grid Menu -->
        <section class="services-grid" aria-label="Menu Dokter - Grid">
            <article class="service-card" aria-labelledby="m-rekammedis">
                <h4 id="m-rekam-medis">Rekam Medis</h4>
                <p class="short">Catatan tindakan dan observasi pasien.</p>
                <small class="muted"><a href="perawat/rekam-medis">Lihat Data</a></small>
            </article>
        </section>
    </main>
</body>

</html>