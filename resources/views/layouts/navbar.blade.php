<div class="navbar">
  <a href="{{ route('home') }}" class="navbar-brand">
    <img src="{{ asset('assets/img/unair-logo.png') }}" alt="UNAIR Logo">
    RSHP UNAIR
  </a>

  <div class="navbar-links">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('struktur') }}">Struktur Organisasi</a>
    <a href="{{ route('visi') }}">Visi, Misi & Tujuan</a>

    <div class="dropdown">
      <a href="{{ route('layanan') }}" class="dropdown-btn">Layanan Umum</a>
      <div class="dropdown-content">
        <div class="dropdown-section">
          <h4>Poliklinik</h4>
          <ul>
            <li>Rawat jalan</li>
            <li>Vaksinasi</li>
            <li>Akupuntur</li>
            <li>Kemoterapi</li>
            <li>Fisioterapi</li>
            <li>Mandi terapi</li>
          </ul>
        </div>
        <div class="dropdown-section">
          <h4>Rawat Inap</h4>
          <p>Rawat inap dilakukan pada pasien berat yang membutuhkan perawatan intensif.</p>
        </div>
        <div class="dropdown-section">
          <h4>Bedah</h4>
          <ul>
            <li><b>Bedah Minor:</b> Jahit luka, Kastrasi, Othematoma, Scaling, Ekstraksi gigi</li>
            <li><b>Bedah Mayor:</b> Gastrotomi, Piometra, Fraktur, Hernia, Eksisi tumor</li>
          </ul>
        </div>
        <div class="dropdown-section">
          <h4>Pemeriksaan</h4>
          <ul>
            <li>Sitologi</li>
            <li>Dermatologi</li>
            <li>Radiografi</li>
            <li>Ultrasonografi</li>
          </ul>
        </div>
      </div>
    </div>

  <a href="{{ route('login') }}">Login</a>

  </div>
</div>
