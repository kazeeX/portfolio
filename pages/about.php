<?php
/**
 * About Page View
 * Developer: Dhaffa Almuhar Dwi Setiawan
 */
?>

<!-- About Header Banner -->
<section class="py-5 bg-white border-bottom">
  <div class="container py-3">
    <div class="row align-items-center gy-4">
      <div class="col-lg-8">
        <span class="text-primary fw-bold text-uppercase small tracking-wider">Profil Singkat</span>
        <h1 class="fw-extrabold display-5 mt-2 mb-3">Tentang Saya</h1>
        <p class="lead text-muted mb-0">
          Saya adalah pelajar kelas 12 dari SMK Taruna Bangsa, Kota Bekasi, jurusan Rekayasa Perangkat Lunak. Saya tertarik di bidang backend development dan saat ini sedang membangun fondasi saya dalam pengembangan web.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end">
        <a href="index.php?page=contact" class="btn btn-primary-custom me-2">
          <i class="bi bi-chat-text-fill me-1"></i> Hubungi Saya
        </a>
        <a href="index.php?page=projects" class="btn btn-outline-custom">
          <i class="bi bi-kanban me-1"></i> Halaman Proyek
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Main Bio & Details Section -->
<section class="py-5">
  <div class="container">
    <div class="row gy-5">
      <!-- Left Column: Bio & Skills -->
      <div class="col-lg-6">
        <!-- Bio Card -->
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
          <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-circle bg-primary-subtle text-primary p-3 d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
              <i class="bi bi-person-badge fs-3"></i>
            </div>
            <div>
              <h3 class="fw-bold mb-0">Dhaffa Almuhar Dwi Setiawan</h3>
              <p class="text-muted small mb-0">Pelajar Rekayasa Perangkat Lunak &bull; SMK Taruna Bangsa Kota Bekasi</p>
            </div>
          </div>

          <p class="text-muted leading-relaxed">
            Saya adalah pelajar kelas 12 dari SMK Taruna Bangsa, Kota Bekasi, jurusan Rekayasa Perangkat Lunak. Saya tertarik di bidang backend development dan saat ini sedang membangun fondasi saya dalam pengembangan web.
          </p>
          <p class="text-muted leading-relaxed mb-0">
            Fokus eksplorasi saya meliputi pembuatan logika server-side menggunakan <strong>PHP</strong> native, pengelolaan basis data relasional dengan <strong>PostgreSQL</strong> dan <strong>PDO prepared statements</strong>, serta perancangan antarmuka yang bersih dan responsif menggunakan <strong>Bootstrap 5</strong>, <strong>HTML</strong>, dan <strong>CSS</strong>.
          </p>

          <!-- Quick Info Pills -->
          <div class="row g-3 mt-3 pt-3 border-top">
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                <div>
                  <div class="small text-muted">Domisili</div>
                  <div class="fw-bold small text-dark">Kota Bekasi, Jawa Barat</div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-mortarboard-fill text-primary fs-5"></i>
                <div>
                  <div class="small text-muted">Status</div>
                  <div class="fw-bold small text-dark">Pelajar Kelas 12 SMK</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Technical Skills / Competencies -->
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Keahlian &amp; Teknologi</h3>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill small">
              Tahap Pembelajaran
            </span>
          </div>
          <p class="text-muted small mb-4">
            Sebagai pelajar, seluruh keahlian di bawah ini sedang aktif saya pelajari dan kembangkan untuk membangun fondasi teknis yang kuat.
          </p>

          <!-- PHP -->
          <div class="p-3 mb-3 rounded-3 border bg-light">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-filetype-php text-primary fs-4"></i>
                <span class="fw-bold text-dark">PHP</span>
              </div>
              <span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold px-2 py-1">
                Sedang dipelajari
              </span>
            </div>
            <p class="small text-muted mb-0 mt-2">
              Mempelajari sintaks dasar PHP native, pemrosesan form, manajemen session, dan PDO.
            </p>
          </div>

          <!-- HTML -->
          <div class="p-3 mb-3 rounded-3 border bg-light">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-code-slash text-danger fs-4"></i>
                <span class="fw-bold text-dark">HTML</span>
              </div>
              <span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold px-2 py-1">
                Sedang dipelajari
              </span>
            </div>
            <p class="small text-muted mb-0 mt-2">
              Menyusun struktur halaman web yang semantik, form input, dan hierarki elemen yang rapi.
            </p>
          </div>

          <!-- CSS -->
          <div class="p-3 mb-3 rounded-3 border bg-light">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-palette text-info fs-4"></i>
                <span class="fw-bold text-dark">CSS</span>
              </div>
              <span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold px-2 py-1">
                Sedang dipelajari
              </span>
            </div>
            <p class="small text-muted mb-0 mt-2">
              Mempelajari styling dasar, layout flexbox, warna, tipografi, dan media queries.
            </p>
          </div>

          <!-- Bootstrap 5 -->
          <div class="p-3 mb-3 rounded-3 border bg-light">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-bootstrap-fill text-purple fs-4" style="color: #7952b3;"></i>
                <span class="fw-bold text-dark">Bootstrap 5</span>
              </div>
              <span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold px-2 py-1">
                Sedang dipelajari
              </span>
            </div>
            <p class="small text-muted mb-0 mt-2">
              Memanfaatkan grid system, komponen navbar, modal, tombol, dan utility classes responsive.
            </p>
          </div>

          <!-- PostgreSQL -->
          <div class="p-3 mb-3 rounded-3 border bg-light">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-database text-info fs-4"></i>
                <span class="fw-bold text-dark">PostgreSQL</span>
              </div>
              <span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold px-2 py-1">
                Sedang dipelajari
              </span>
            </div>
            <p class="small text-muted mb-0 mt-2">
              Mempelajari pemodelan data relasional, query DDL/DML, dan prepared statements melalui PDO.
            </p>
          </div>

          <!-- Git -->
          <div class="p-3 rounded-3 border bg-light">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-git text-danger fs-4"></i>
                <span class="fw-bold text-dark">Git</span>
              </div>
              <span class="badge bg-primary-subtle text-primary border border-primary-subtle fw-semibold px-2 py-1">
                Sedang dipelajari
              </span>
            </div>
            <p class="small text-muted mb-0 mt-2">
              Mempelajari kontrol versi, branching dasar, commit workflow, dan hosting repository di GitHub.
            </p>
          </div>
        </div>
      </div>

      <!-- Right Column: Education & Learning Journey -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white h-100">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Pendidikan &amp; Perjalanan Belajar</h3>
            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill small">
              Aktif Pelajar
            </span>
          </div>

          <div class="timeline">
            <!-- Timeline item 1 -->
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="badge bg-primary-subtle text-primary mb-1">2024 - Sekarang</div>
              <h5 class="fw-bold mb-1">Kelas 12 &mdash; Rekayasa Perangkat Lunak</h5>
              <div class="text-muted small mb-2">SMK Taruna Bangsa, Kota Bekasi</div>
              <p class="text-muted small mb-0">
                Fokus mendalami pengembangan backend menggunakan native PHP, manipulasi data dengan PostgreSQL, dan persiapan proyek kejuruan akhir.
              </p>
            </div>

            <!-- Timeline item 2 -->
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="badge bg-primary-subtle text-primary mb-1">2023 - 2024</div>
              <h5 class="fw-bold mb-1">Kelas 11 &mdash; Rekayasa Perangkat Lunak</h5>
              <div class="text-muted small mb-2">SMK Taruna Bangsa, Kota Bekasi</div>
              <p class="text-muted small mb-0">
                Mempelajari dasar basis data relasional (SQL), konsep antarmuka responsive dengan Bootstrap, serta alur form request dan response pada web.
              </p>
            </div>

            <!-- Timeline item 3 -->
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="badge bg-primary-subtle text-primary mb-1">2022 - 2023</div>
              <h5 class="fw-bold mb-1">Kelas 10 &mdash; Pengenalan RPL &amp; Logika Pemrograman</h5>
              <div class="text-muted small mb-2">SMK Taruna Bangsa, Kota Bekasi</div>
              <p class="text-muted small mb-0">
                Memulai langkah pertama dalam dunia IT dengan mempelajari logika algoritma, struktur web dasar menggunakan HTML dan CSS, serta pengenalan Git.
              </p>
            </div>
          </div>

          <!-- Student Philosophy Quote -->
          <div class="mt-5 p-3 rounded-3 bg-light border-start border-4 border-primary">
            <blockquote class="blockquote mb-1 fs-6 text-dark fst-italic">
              "Setiap baris kode adalah kesempatan untuk belajar. Saya berkomitmen membangun fondasi yang kokoh demi menjadi backend developer yang andal."
            </blockquote>
            <figcaption class="blockquote-footer mt-2 mb-0 text-muted small">
              Dhaffa Almuhar Dwi Setiawan
            </figcaption>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
