<?php
/**
 * Contact Page View
 * Developer: Dhaffa Almuhar Dwi Setiawan
 *
 * Interactive contact form with server-side PHP validation.
 * Protected by a per-session CSRF token and a honeypot anti-spam field.
 * Messages are stored in the PostgreSQL database (contact_messages table)
 * instead of being sent via SMTP email, so the form keeps working on free
 * hosting plans (e.g. WebHostMost) where external SMTP is disabled.
 */

// Load database configuration (exposes $pdo via getDatabaseConnection())
require_once dirname(__DIR__) . '/config/database.php';

$formSubmitted = false;
$successMessage = null;
$errorMessage = null;

// Form field retention variables
$name = '';
$email = '';
$subject = '';
$message = '';

// CSRF token: random per-session value embedded in the form as a hidden
// field and verified again on submit (the session is started in index.php).
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formSubmitted = true;

    // --- Anti-spam & CSRF guards (checked before anything is saved) ---
    // Honeypot: the "website" field is invisible to human visitors, so only
    // bots fill it in. If it has any value: fake a success, store nothing.
    // CSRF: the hidden token in the form must match this session's token.
    $guardPassed = true;
    if (!empty($_POST['website'])) {
        $successMessage = 'Terima kasih! Pesan Anda telah diterima dan tersimpan. Saya akan membalas melalui email Anda secepatnya.';
        $guardPassed = false;
    } elseif (!isset($_POST['csrf_token'], $_SESSION['csrf_token'])
        || !hash_equals($_SESSION['csrf_token'], (string) $_POST['csrf_token'])) {
        $errorMessage = 'Sesi formulir tidak valid atau sudah kedaluwarsa. Silakan muat ulang halaman ini, lalu coba kirim lagi.';
        $guardPassed = false;
    }

    if ($guardPassed) {
    // Sanitize and trim inputs
    $name    = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
    $email   = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
    $subject = isset($_POST['subject']) ? trim(strip_tags($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

    // Server-side validation
    if (empty($name)) {
        $errorMessage = 'Silakan masukkan nama lengkap Anda.';
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Silakan masukkan alamat email yang valid.';
    } elseif (empty($subject)) {
        $errorMessage = 'Silakan masukkan subjek pesan.';
    } elseif (empty($message) || mb_strlen($message) < 10) {
        $errorMessage = 'Silakan tulis pesan minimal 10 karakter.';
    } else {
        // Save message to database (no SMTP needed)
        try {
            if (!isset($pdo) || !($pdo instanceof PDO)) {
                $dbErr = null;
                $pdo = function_exists('getDatabaseConnection') ? getDatabaseConnection($dbErr) : null;
            }

            if (!($pdo instanceof PDO)) {
                throw new RuntimeException('Koneksi database tidak tersedia.');
            }

            $stmt = $pdo->prepare(
                'INSERT INTO contact_messages (name, email, subject, message) ' .
                'VALUES (:name, :email, :subject, :message)'
            );
            $stmt->execute([
                ':name'    => $name,
                ':email'   => $email,
                ':subject' => $subject,
                ':message' => $message,
            ]);

            // Show success message
            $successMessage = 'Terima kasih, ' . htmlspecialchars($name) . '! Pesan Anda telah diterima dan tersimpan. Saya akan membalas melalui email Anda secepatnya.';

            // Reset fields after successful submission
            $name = '';
            $email = '';
            $subject = '';
            $message = '';

            // Rotate the CSRF token so the just-used one cannot be replayed
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } catch (Throwable $e) {
            // Log technical error details (never shown to visitors)
            error_log('Contact form DB error: ' . $e->getMessage());
            $errorMessage = 'Pesan gagal disimpan. Silakan coba lagi atau hubungi via email langsung.';
        }
    }
    } // end anti-spam & CSRF guard
}
?>

<!-- Contact Header Banner -->
<section class="py-5 bg-white border-bottom">
  <div class="container py-3">
    <div class="row align-items-center gy-4">
      <div class="col-lg-8">
        <span class="text-primary fw-bold text-uppercase small tracking-wider">Mari Terhubung</span>
        <h1 class="fw-extrabold display-5 mt-2 mb-2">Hubungi Saya</h1>
        <p class="lead text-muted mb-0">
          Tertarik berdiskusi seputar web development, berbagi masukan, atau memiliki pertanyaan? Jangan ragu untuk menghubungi saya.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end">
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
          <i class="bi bi-clock-history me-1"></i> Respon Cepat
        </span>
      </div>
    </div>
  </div>
</section>

<!-- Contact Form & Info Section -->
<section class="py-5">
  <div class="container">
    <div class="row gy-5">
      <!-- Contact Info Cards Column -->
      <div class="col-lg-5">
        <div class="contact-info-card h-100">
          <h3 class="fw-bold mb-4">Informasi Kontak</h3>
          <p class="text-muted small mb-4">
            Anda dapat menghubungi saya langsung melalui saluran kontak di bawah ini atau mengirimkan pesan melalui formulir.
          </p>

          <!-- Email -->
          <div class="contact-item">
            <div class="contact-icon">
              <i class="bi bi-envelope-at-fill"></i>
            </div>
            <div>
              <div class="small text-muted fw-semibold">Email</div>
              <a href="mailto:dpaimuse@gmail.com" class="text-dark fw-bold text-decoration-none">
                dpaimuse@gmail.com
              </a>
            </div>
          </div>

          <!-- GitHub -->
          <div class="contact-item">
            <div class="contact-icon">
              <i class="bi bi-github"></i>
            </div>
            <div>
              <div class="small text-muted fw-semibold">GitHub</div>
              <a href="https://github.com/kazeeX" target="_blank" rel="noopener noreferrer" class="text-dark fw-bold text-decoration-none">
                github.com/kazeeX
              </a>
            </div>
          </div>

          <!-- Instagram -->
          <div class="contact-item">
            <div class="contact-icon">
              <i class="bi bi-instagram text-danger"></i>
            </div>
            <div>
              <div class="small text-muted fw-semibold">Instagram</div>
              <a href="https://instagram.com/kazelll08" target="_blank" rel="noopener noreferrer" class="text-dark fw-bold text-decoration-none">
                @kazelll08
              </a>
            </div>
          </div>

          <!-- LinkedIn -->
          <div class="contact-item">
            <div class="contact-icon">
              <i class="bi bi-linkedin text-primary"></i>
            </div>
            <div>
              <div class="small text-muted fw-semibold">LinkedIn</div>
              <a href="https://www.linkedin.com/search/results/all/?keywords=Dhaffa%20Almuhar%20Dwi%20S" target="_blank" rel="noopener noreferrer" class="text-dark fw-bold text-decoration-none">
                Dhaffa Almuhar Dwi S
              </a>
            </div>
          </div>

          <!-- Location -->
          <div class="contact-item">
            <div class="contact-icon">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
              <div class="small text-muted fw-semibold">Lokasi</div>
              <div class="text-dark fw-bold">
                Kota Bekasi, Jawa Barat, Indonesia
              </div>
            </div>
          </div>

          <!-- Social Profiles Row -->
          <hr class="my-4">
          <h5 class="fw-bold mb-3 fs-6">Tautan Sosial Media</h5>
          <div class="d-flex gap-2">
            <a href="mailto:dpaimuse@gmail.com" class="footer-social-link" title="Email: dpaimuse@gmail.com" data-bs-toggle="tooltip">
              <i class="bi bi-envelope-fill"></i>
            </a>
            <a href="https://github.com/kazeeX" target="_blank" rel="noopener noreferrer" class="footer-social-link" title="GitHub (kazeeX)" data-bs-toggle="tooltip">
              <i class="bi bi-github"></i>
            </a>
            <a href="https://instagram.com/kazelll08" target="_blank" rel="noopener noreferrer" class="footer-social-link" title="Instagram (@kazelll08)" data-bs-toggle="tooltip">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="https://www.linkedin.com/search/results/all/?keywords=Dhaffa%20Almuhar%20Dwi%20S" target="_blank" rel="noopener noreferrer" class="footer-social-link" title="LinkedIn: Dhaffa Almuhar Dwi S" data-bs-toggle="tooltip">
              <i class="bi bi-linkedin"></i>
            </a>
          </div>

          <!-- Student Status Box -->
          <div class="mt-4 p-3 rounded-3 bg-light border">
            <div class="d-flex align-items-center gap-2 text-primary fw-semibold small mb-1">
              <i class="bi bi-mortarboard-fill"></i>
              Status Pendidikan
            </div>
            <p class="small text-muted mb-0">
              Pelajar Kelas 12 Rekayasa Perangkat Lunak di SMK Taruna Bangsa, Kota Bekasi. Terbuka untuk diskusi web development dan saran belajar.
            </p>
          </div>
        </div>
      </div>

      <!-- Contact Form Column -->
      <div class="col-lg-7">
        <div class="form-card">
          <h3 class="fw-bold mb-2">Kirim Pesan</h3>
          <p class="text-muted small mb-4">
            Isi formulir di bawah ini dan saya akan merespons pesan Anda secepatnya.
          </p>

          <!-- Success Alert -->
          <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show auto-dismiss rounded-3 shadow-sm mb-4" role="alert">
              <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
              <span><?= htmlspecialchars($successMessage) ?></span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <!-- Error Alert -->
          <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
              <div class="d-flex align-items-start">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 flex-shrink-0 mt-1"></i>
                <div class="flex-grow-1">
                  <div><?= htmlspecialchars($errorMessage) ?></div>
                </div>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          <?php endif; ?>

          <form action="index.php?page=contact" method="POST" class="needs-validation" novalidate>
            <!-- CSRF token (verified server-side when the form is submitted) -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <!-- Honeypot anti-spam: hidden from humans; bots that fill it are silently dropped -->
            <div style="display:none" aria-hidden="true">
              <label>Jangan isi kolom ini: <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
            </div>
            <div class="row g-3">
              <!-- Name -->
              <div class="col-md-6">
                <label for="contactName" class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                  <input
                    type="text"
                    class="form-control"
                    id="contactName"
                    name="name"
                    value="<?= htmlspecialchars($name) ?>"
                    placeholder="Nama Anda"
                    required
                  >
                  <div class="invalid-feedback">Silakan masukkan nama Anda.</div>
                </div>
              </div>

              <!-- Email -->
              <div class="col-md-6">
                <label for="contactEmail" class="form-label fw-semibold small">Alamat Email <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                  <input
                    type="email"
                    class="form-control"
                    id="contactEmail"
                    name="email"
                    value="<?= htmlspecialchars($email) ?>"
                    placeholder="nama@email.com"
                    required
                  >
                  <div class="invalid-feedback">Silakan masukkan alamat email yang valid.</div>
                </div>
              </div>

              <!-- Subject -->
              <div class="col-12">
                <label for="contactSubject" class="form-label fw-semibold small">Subjek Pesan <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light text-muted"><i class="bi bi-chat-left-dots"></i></span>
                  <input
                    type="text"
                    class="form-control"
                    id="contactSubject"
                    name="subject"
                    value="<?= htmlspecialchars($subject) ?>"
                    placeholder="Diskusi Proyek / Pertanyaan / Saran"
                    required
                  >
                  <div class="invalid-feedback">Silakan masukkan subjek pesan.</div>
                </div>
              </div>

              <!-- Message -->
              <div class="col-12">
                <label for="contactMessage" class="form-label fw-semibold small">Isi Pesan <span class="text-danger">*</span></label>
                <textarea
                  class="form-control"
                  id="contactMessage"
                  name="message"
                  rows="5"
                  placeholder="Tuliskan pesan, pertanyaan, atau tanggapan Anda di sini..."
                  required
                ><?= htmlspecialchars($message) ?></textarea>
                <div class="invalid-feedback">Silakan tulis pesan (minimal 10 karakter).</div>
              </div>

              <!-- Submit Button -->
              <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary-custom w-100 py-3 fw-bold">
                  <i class="bi bi-send-fill me-2"></i> Kirim Pesan
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
