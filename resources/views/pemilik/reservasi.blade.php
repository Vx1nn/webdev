@include('layouts.lte.navbar')

<!doctype html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="assets/css/pico.yellow.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Data Reservasi - Pemilik Dashboard</title>
</head>

<body>
    <main class="container">
        <section class="hero">
            <div class="center-row">
                <h1>Data Reservasi Saya</h1>
            </div>
        </section>
        <table role="grid">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Pet</th>
                    <th>Dokter</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $idx => $row)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td>{{ $row->waktu_daftar }}</td>
                        <td>{{ $row->pet->nama ?? '-' }}</td>
                        <td>{{ $row->roleUser->user->nama ?? '-' }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>