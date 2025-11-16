<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rumah Sakit Hewan Pendidikan - UNAIR</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

@include('layouts.navbar')

  <section class="home-section" id="home">
    <div class="home-overlay">
      <div class="home-content">
        <h2>Selamat Datang di RSHP UNAIR</h2>
        <p>
          RSHP Universitas Airlangga merupakan pusat pelayanan kesehatan hewan 
          yang berorientasi pada pendidikan, penelitian, dan pengabdian masyarakat. 
          Kami mengedepankan profesionalisme dan kesejahteraan hewan dalam setiap tindakan medis.
        </p>
      </div>
    </div>
  </section>

  <main>
    <section class="container" id="struktur">
      <div class="card">
        <div class="card-header">Struktur Organisasi</div>
        <div class="card-body center">
          <img src="{{ asset('assets/img/struktur-rshp.jpg') }}" alt="Struktur RSHP" class="struktur-img">
        </div>
      </div>
    </section>

    <section class="container" id="visi">
      <div class="card">
        <div class="card-header">Visi, Misi, dan Tujuan</div>
        <div class="card-body">
          <h3 class="sub-title">VISI</h3>
          <p class="paragraph">
            Menjadi Rumah Sakit Hewan Pendidikan terkemuka di tingkat nasional dan internasional 
            dalam pelayanan, pendidikan, dan penelitian yang unggul serta bermartabat.
          </p>

          <h3 class="sub-title">MISI</h3>
          <ul class="misi-list">
            <li>Menyelenggarakan pelayanan terintegrasi yang bermutu dan aman.</li>
            <li>Menyelenggarakan pendidikan dan pelatihan di bidang kedokteran hewan.</li>
            <li>Melakukan penelitian berbasis inovasi di bidang kesehatan hewan.</li>
            <li>Menjadi pusat rujukan kedokteran hewan yang unggul.</li>
            <li>Mengembangkan manajemen rumah sakit hewan yang efisien dan produktif.</li>
          </ul>

          <h3 class="sub-title">TUJUAN</h3>
          <p class="paragraph">
            Menjadi rumah sakit hewan yang adaptif, kreatif, dan proaktif terhadap perkembangan ilmu pengetahuan 
            serta memiliki tata kelola yang baik.
          </p>
        </div>
      </div>
    </section>

    <section class="container" id="layanan">
      <div class="card">
        <div class="card-header">Layanan Kami</div>
        <div class="card-body grid">

          <div class="list-item">
            Poliklinik
            <div class="dropdown-detail">
              <ul>
                <li>Rawat Jalan</li>
                <li>Vaksinasi</li>
                <li>Akupuntur</li>
                <li>Kemoterapi</li>
                <li>Fisioterapi</li>
                <li>Mandi Terapi</li>
              </ul>
            </div>
          </div>

          <div class="list-item">
            Rawat Inap
            <div class="dropdown-detail">
              <p>Rawat inap dilakukan pada pasien yang membutuhkan perawatan intensif 
                di bawah pengawasan dokter dan paramedis berpengalaman.
              </p>
            </div>
          </div>

          <div class="list-item">
            Bedah
            <div class="dropdown-detail">
              <p><b>Bedah Minor:</b> Jahit luka, Kastrasi, Scaling, Ekstraksi gigi</p>
              <p><b>Bedah Mayor:</b> Gastrotomi, Piometra, Hernia, Eksisi tumor</p>
            </div>
          </div>

          <div class="list-item">
            Pemeriksaan
            <div class="dropdown-detail">
              <ul>
                <li>Sitologi</li>
                <li>Dermatologi</li>
                <li>Hematologi</li>
                <li>Radiografi</li>
                <li>Ultrasonografi</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container" id="kontak">
      <div class="card">
        <div class="card-header">Kontak Kami</div>
        <div class="map-container">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d922.0196885531292!2d112.78714369310941!3d-7.2703967117540245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd40a9784f5%3A0xe756f6ae03eab99!2sRumah%20Sakit%20Hewan%20Pendidikan%20Universitas%20Airlangga!5e0!3m2!1sid!2sid!4v1757469135795!5m2!1sid!2sid"
            allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="card-body">
          <p>Telepon: 031 5927832</p>
          <p>Email: rshp@fkh.unair.ac.id</p>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
  </footer>

</body>
</html>
