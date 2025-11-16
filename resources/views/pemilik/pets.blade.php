@include('layouts.lte.navbar')

<!doctype html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="assets/css/pico.yellow.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Data Pet - Pemilik Dashboard</title>
</head>

<body>
    <main class="container">
        <section class="hero">
            <div class="center-row">
                <h1>Data Pet Saya</h1>
            </div>
        </section>
        <table role="grid">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Ras</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->rasHewan->nama_ras ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>