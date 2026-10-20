<?php
/**
 * Home Page View
 * Developer: Dhaffa Almuhar Dwi Setiawan
 */
?>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-7 text-center text-lg-start">
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3 fw-semibold">
          <i class="bi bi-mortarboard-fill me-1"></i> Pelajar SMK Taruna Bangsa &bull; Rekayasa Perangkat Lunak
        </span>
        <h1 class="display-4 fw-extrabold mb-3 lh-sm">
          Hi, I'm <span class="text-gradient">Dhaffa</span>.<br>
          <span class="fs-2 text-dark fw-bold">Dhaffa Almuhar Dwi Setiawan</span>
        </h1>
        <p class="lead text-muted mb-4 pe-lg-4">
          Saya adalah pelajar kelas 12 dari SMK Taruna Bangsa, Kota Bekasi, jurusan Rekayasa Perangkat Lunak. Saya tertarik di bidang backend development dan saat ini sedang membangun fondasi saya dalam pengembangan web.
        </p>

        <!-- CTA Action Buttons -->
        <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
          <a href="index.php?page=projects" class="btn btn-primary-custom">
            <i class="bi bi-grid-fill me-2"></i> Lihat Proyek
          </a>
          <a href="index.php?page=contact" class="btn btn-outline-custom">
            <i class="bi bi-envelope-open me-2"></i> Hubungi Saya
          </a>
        </div>

        <!-- Tech Stack Highlights / Skills Section -->
        <div class="mt-5 pt-3 border-top">
          <p class="small text-muted fw-semibold mb-2 text-uppercase tracking-wider">Keahlian &amp; Teknologi</p>
          <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-2">
            <span class="skill-badge">
              <i class="bi bi-filetype-php text-primary fs-5"></i>
              <span>PHP</span>
              <span class="badge bg-primary-subtle text-primary ms-1 small">Sedang dipelajari</span>
            </span>
            <span class="skill-badge">
              <i class="bi bi-code-slash text-danger fs-5"></i>
              <span>HTML</span>
              <span class="badge bg-primary-subtle text-primary ms-1 small">Sedang dipelajari</span>
            </span>
            <span class="skill-badge">
              <i class="bi bi-palette text-info fs-5"></i>
              <span>CSS</span>
              <span class="badge bg-primary-subtle text-primary ms-1 small">Sedang dipelajari</span>
            </span>
            <span class="skill-badge">
              <i class="bi bi-bootstrap-fill text-purple fs-5" style="color: #7952b3;"></i>
              <span>Bootstrap 5</span>
              <span class="badge bg-primary-subtle text-primary ms-1 small">Sedang dipelajari</span>
            </span>
            <span class="skill-badge">
              <i class="bi bi-database text-info fs-5"></i>
              <span>PostgreSQL</span>
              <span class="badge bg-primary-subtle text-primary ms-1 small">Sedang dipelajari</span>
            </span>
            <span class="skill-badge">
              <i class="bi bi-git text-danger fs-5"></i>
              <span>Git</span>
              <span class="badge bg-primary-subtle text-primary ms-1 small">Sedang dipelajari</span>
            </span>
          </div>
        </div>
      </div>

      <!-- Hero Visual Avatar / Photo Placeholder -->
      <div class="col-lg-5 text-center">
        <div class="position-relative d-inline-block">
          <img src="assets/img/profile.jpg" alt="Dhaffa Almuhar Dwi Setiawan" class="hero-avatar">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Stats / Highlights Section -->
<section class="py-5 bg-white border-top border-bottom">
  <div class="container">
    <div class="row g-4 text-center">
      <div class="col-6 col-md-3">
        <h3 class="display-6 fw-bold text-primary mb-1">Kelas 12</h3>
        <p class="text-muted mb-0 small text-uppercase fw-semibold">Tingkat Pendidikan</p>
      </div>
      <div class="col-6 col-md-3">
        <h3 class="display-6 fw-bold text-primary mb-1">RPL</h3>
        <p class="text-muted mb-0 small text-uppercase fw-semibold">Jurusan Keahlian</p>
      </div>
      <div class="col-6 col-md-3">
        <h3 class="display-6 fw-bold text-primary mb-1">Bekasi</h3>
        <p class="text-muted mb-0 small text-uppercase fw-semibold">SMK Taruna Bangsa</p>
      </div>
      <div class="col-6 col-md-3">
        <h3 class="display-6 fw-bold text-primary mb-1">Backend</h3>
        <p class="text-muted mb-0 small text-uppercase fw-semibold">Minat Spesialisasi</p>
      </div>
    </div>
  </div>
</section>

<!-- What I Do / Fokus & Minat Section -->
<section class="py-5 my-3">
  <div class="container">
    <div class="text-center max-w-xl mx-auto mb-5">
      <span class="text-primary fw-bold text-uppercase small tracking-wider">Fokus &amp; Minat</span>
      <h2 class="fw-bold mt-2">Bidang yang Sedang Saya Dalami</h2>
      <p class="text-muted">Membangun fondasi yang kokoh dalam rekayasa perangkat lunak dan pengembangan web.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-card h-100">
          <div class="feature-icon-wrapper">
            <i class="bi bi-code-square"></i>
          </div>
          <h4 class="h5 fw-bold mb-2">Backend Development</h4>
          <p class="text-muted mb-0 small">
            Mempelajari logika pemrograman server-side menggunakan PHP native, pemrosesan data form, sesi (sessions), dan struktur arsitektur web yang rapi.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-card h-100">
          <div class="feature-icon-wrapper">
            <i class="bi bi-database-check"></i>
          </div>
          <h4 class="h5 fw-bold mb-2">PostgreSQL &amp; Basis Data</h4>
          <p class="text-muted mb-0 small">
            Merancang tabel basis data relasional, menulis query SQL, dan mengimplementasikan koneksi aman menggunakan PDO prepared statements.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-card h-100">
          <div class="feature-icon-wrapper">
            <i class="bi bi-phone"></i>
          </div>
          <h4 class="h5 fw-bold mb-2">Web Responsif &amp; UI</h4>
          <p class="text-muted mb-0 small">
            Membangun antarmuka web yang bersih dan responsif menggunakan HTML, CSS, dan framework Bootstrap 5 agar nyaman diakses di smartphone maupun desktop.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Banner -->
<section class="py-5 mb-5">
  <div class="container">
    <div class="bg-primary text-white rounded-4 p-4 p-md-5 text-center text-md-start position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #4f46e5 0%, #1e1b4b 100%);">
      <div class="row align-items-center gy-4">
        <div class="col-md-8">
          <h2 class="fw-bold mb-2 text-white">Ingin terhubung atau berdiskusi?</h2>
          <p class="mb-0 text-white-50">
            Jangan ragu untuk mengirimkan pesan, pertanyaan, atau saran melalui halaman kontak.
          </p>
        </div>
        <div class="col-md-4 text-md-end">
          <a href="index.php?page=contact" class="btn btn-light text-primary fw-bold px-4 py-2 rounded-3 shadow">
            Hubungi Saya <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
