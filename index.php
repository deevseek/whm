<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>WMH - Website Mental Health</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body class="landing-body">
  <header class="topbar">
    <div class="brand">
      <div class="logo">🧠</div>
      <div>
        <div class="brand-title">WMH</div>
        <div class="brand-sub">Website Mental Health</div>
      </div>
    </div>
    <nav class="main-nav">
      <a href="index.php" class="active">Beranda</a>
      <a href="test.php">Tes</a>
      <a href="articles.php">Artikel</a>
      <a href="videos.php">Video</a>
      <a href="books.php">Buku</a>
      <a href="#tentang-kami">Tentang Kami</a>
      <a href="appointment.php">Kontak</a>
    </nav>
    <div class="user-pill">
      <span class="notification-icon">🔔</span>
      <span>Siswa ▾</span>
    </div>
  </header>

  <main class="landing-wrap">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-content">
        <div class="hero-text">
          <h1>Selamat datang di WMH</h1>
          <p>Platform kesehatan mental yang aman, terpercaya, dan mudah diakses untuk semua</p>
          <div class="hero-buttons">
            <a href="test.php" class="btn btn-primary">Mulai Tes Sekarang →</a>
            <a href="appointment.php" class="btn btn-secondary">Buat Janji Konseling</a>
          </div>
        </div>
        <div class="hero-illustration">
          <div style="font-size: 120px; line-height: 1;">💙</div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="tentang-kami">
      <h2>Fitur Layanan WMH</h2>
      <div class="features-grid">
        <article class="feature-card">
          <div class="feature-icon">🧠</div>
          <h3>Tes Kesehatan Mental</h3>
          <p>Kenali kondisi kesehatan mentalmu melalui tes yang aman dan terpercaya dengan hasil yang akurat.</p>
          <a href="test.php" class="btn btn-link">Mulai Tes →</a>
        </article>

        <article class="feature-card">
          <div class="feature-icon">📅</div>
          <h3>Jadwal Konseling</h3>
          <p>Lihat jadwal konseling yang tersedia dan atur waktu dengan konselor profesional kami.</p>
          <a href="appointment.php" class="btn btn-link">Lihat Jadwal →</a>
        </article>

        <article class="feature-card">
          <div class="feature-icon">💬</div>
          <h3>Sesi Konseling</h3>
          <p>Ikuti sesi konseling online dengan aman, nyaman, dan privasi terjaga sepenuhnya.</p>
          <a href="appointment.php" class="btn btn-link">Mulai Konseling →</a>
        </article>

        <article class="feature-card">
          <div class="feature-icon">📖</div>
          <h3>Artikel & Tips</h3>
          <p>Baca berbagai artikel menarik seputar kesehatan mental dan pengembangan diri yang bermanfaat.</p>
          <a href="articles.php" class="btn btn-link">Baca Artikel →</a>
        </article>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-section">
      <h2>Mengapa Memilih WMH?</h2>
      <div class="why-grid">
        <div class="why-item">
          <div class="why-icon">✔️</div>
          <h4>Aman & Terpercaya</h4>
          <p>Data Anda dilindungi dengan keamanan tingkat tinggi dan privasi terjamin</p>
        </div>
        <div class="why-item">
          <div class="why-icon">👨‍⚕️</div>
          <h4>Konselor Profesional</h4>
          <p>Tim konselor berpengalaman siap membantu Anda kapan saja</p>
        </div>
        <div class="why-item">
          <div class="why-icon">⏰</div>
          <h4>Akses 24/7</h4>
          <p>Akses platform kapan saja, di mana saja sesuai kebutuhan Anda</p>
        </div>
        <div class="why-item">
          <div class="why-icon">🎯</div>
          <h4>Hasil Akurat</h4>
          <p>Tes dirancang oleh ahli untuk memberikan hasil yang akurat dan terpercaya</p>
        </div>
      </div>
    </section>

    <!-- Footer Info Section -->
    <section class="footer-info-section">
      <div class="footer-info-grid">
        <div class="footer-info-item">
          <h4>WMH</h4>
          <p><strong>Website Mental Health</strong></p>
          <p>Platform kesehatan mental yang membantu Anda menjadi lebih baik setiap hari.</p>
          <div class="social-links">
            <a href="#">f</a>
            <a href="#">t</a>
            <a href="#">ig</a>
            <a href="#">in</a>
          </div>
        </div>

        <div class="footer-info-item">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="test.php">Tes</a></li>
            <li><a href="articles.php">Artikel</a></li>
            <li><a href="videos.php">Video</a></li>
            <li><a href="books.php">Buku</a></li>
          </ul>
        </div>

        <div class="footer-info-item">
          <h4>Hubungi Kami</h4>
          <ul>
            <li>📞 0812-3456-7890</li>
            <li>📧 info@wmh.id</li>
            <li>📍 Jl. Pendidikan No.1</li>
            <li>Kota Anda</li>
          </ul>
        </div>
      </div>
    </section>
  </main>

  <footer class="landing-footer">© 2026 WMH. Semua hak dilindungi.</footer>

  <style>
    /* Tambahan CSS untuk home page */
    .hero-section {
      padding: 60px 40px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 12px;
      margin: 40px 0;
    }

    .hero-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1000px;
      margin: 0 auto;
      gap: 60px;
    }

    .hero-text h1 {
      font-size: 48px;
      margin: 0 0 20px 0;
      font-weight: 700;
    }

    .hero-text p {
      font-size: 18px;
      margin: 0 0 30px 0;
      opacity: 0.95;
    }

    .hero-buttons {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    .btn-primary {
      background: white;
      color: #667eea;
      font-weight: 600;
    }

    .btn-primary:hover {
      background: #f0f0f0;
    }

    .btn-secondary {
      background: transparent;
      color: white;
      border: 2px solid white;
      font-weight: 600;
    }

    .btn-secondary:hover {
      background: rgba(255,255,255,0.1);
    }

    .hero-illustration {
      flex-shrink: 0;
    }

    .features-section {
      padding: 80px 40px;
      text-align: center;
    }

    .features-section h2 {
      font-size: 36px;
      margin-bottom: 50px;
      color: #333;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .feature-card {
      background: white;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    .feature-icon {
      font-size: 48px;
      margin-bottom: 20px;
    }

    .feature-card h3 {
      font-size: 20px;
      margin: 0 0 15px 0;
      color: #333;
    }

    .feature-card p {
      color: #666;
      line-height: 1.6;
      margin-bottom: 25px;
      font-size: 14px;
    }

    .btn-link {
      color: #667eea;
      background: transparent;
      border: none;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      padding: 0;
      font-size: 14px;
    }

    .btn-link:hover {
      text-decoration: underline;
    }

    .why-section {
      padding: 80px 40px;
      background: #f8f9fa;
      text-align: center;
    }

    .why-section h2 {
      font-size: 36px;
      margin-bottom: 50px;
      color: #333;
    }

    .why-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .why-item {
      padding: 30px 20px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .why-icon {
      font-size: 40px;
      margin-bottom: 15px;
    }

    .why-item h4 {
      font-size: 18px;
      margin: 0 0 10px 0;
      color: #333;
    }

    .why-item p {
      color: #666;
      font-size: 14px;
      line-height: 1.6;
      margin: 0;
    }

    .footer-info-section {
      padding: 60px 40px;
      background: #f8f9fa;
      border-top: 1px solid #e0e0e0;
    }

    .footer-info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .footer-info-item h4 {
      font-size: 18px;
      font-weight: 700;
      margin: 0 0 15px 0;
      color: #333;
    }

    .footer-info-item p {
      color: #666;
      font-size: 14px;
      line-height: 1.8;
      margin: 0 0 10px 0;
    }

    .footer-info-item ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-info-item ul li {
      color: #666;
      font-size: 14px;
      margin-bottom: 8px;
    }

    .footer-info-item a {
      color: #667eea;
      text-decoration: none;
    }

    .footer-info-item a:hover {
      text-decoration: underline;
    }

    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }

    .social-links a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: #667eea;
      color: white;
      border-radius: 50%;
      text-decoration: none;
      font-weight: 600;
      font-size: 12px;
    }

    .social-links a:hover {
      background: #764ba2;
    }

    .notification-icon {
      margin-right: 10px;
      font-size: 18px;
    }

    @media (max-width: 768px) {
      .hero-content {
        flex-direction: column;
        gap: 30px;
        padding: 40px 20px;
      }

      .hero-text h1 {
        font-size: 32px;
      }

      .hero-text p {
        font-size: 16px;
      }

      .hero-buttons {
        flex-direction: column;
      }

      .features-grid {
        grid-template-columns: 1fr;
      }

      .why-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .footer-info-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</body>
</html>
