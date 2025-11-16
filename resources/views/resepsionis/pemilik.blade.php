@include('layouts.lte.navbar')

<!doctype html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="assets/css/pico.yellow.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Data Pemilik - Resepsionis Dashboard</title>
</head>

<body>
    <main class="container">
        <section class="hero">
            <div class="center-row">
                <h1>Data Pemilik</h1>
            </div>
        </section>
        <table role="grid">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. WhatsApp</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemilik as $p)
                    <tr>
                        <td>{{ $p->user->nama ?? '-' }}</td>
                        <td>{{ $p->no_wa ?? '-' }}</td>
                        <td>{{ $p->alamat ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>