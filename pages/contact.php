<?php
/**
 * Contact Page View
 * Developer: Dhaffa Almuhar Dwi Setiawan
 * 
 * Interactive contact form with server-side PHP validation, PHPMailer Gmail SMTP, and feedback.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer autoloader and mail configuration
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/config/mail.php';

$formSubmitted = false;
$successMessage = null;
$errorMessage = null;

// Form field retention variables
$name = '';
$email = '';
$subject = '';
$message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formSubmitted = true;
    
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
        // Send email via PHPMailer using Gmail SMTP
        $mail = new PHPMailer(true);

        try {
            // SMTP Server Configuration
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = SMTP_AUTH;
            $mail->Username   = SMTP_USER;
            $mail->Password   = SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = SMTP_PORT;
            $mail->CharSet    = 'UTF-8';

            // Sender and Recipient Configuration
            // Gmail requires the From address to match the authenticated account
            $mail->setFrom(SMTP_USER, 'Portfolio - ' . $name);
            $mail->addAddress(MAIL_TO_ADDRESS, MAIL_TO_NAME);
            $mail->addReplyTo($email, $name);

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = '[Portfolio Contact] ' . $subject;

            // HTML Body
            $safeName    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
            $safeEmail   = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            $safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
            $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

            $mail->Body = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #1e293b; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; background-color: #ffffff;'>
              <h2 style='color: #4f46e5; margin-top: 0; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; font-size: 20px;'>
                Pesan Baru dari Formulir Kontak Portfolio
              </h2>
              <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 14px;'>
                <tr>
                  <td style='padding: 8px 0; width: 140px; color: #64748b; font-weight: bold;'>Nama Pengirim:</td>
                  <td style='padding: 8px 0; color: #0f172a;'>{$safeName}</td>
                </tr>
                <tr>
                  <td style='padding: 8px 0; color: #64748b; font-weight: bold;'>Email Pengirim:</td>
                  <td style='padding: 8px 0;'><a href='mailto:{$safeEmail}' style='color: #4f46e5; text-decoration: none;'>{$safeEmail}</a></td>
                </tr>
                <tr>
                  <td style='padding: 8px 0; color: #64748b; font-weight: bold;'>Subjek:</td>
                  <td style='padding: 8px 0; color: #0f172a;'>{$safeSubject}</td>
                </tr>
              </table>
              <div style='background-color: #f8fafc; border-left: 4px solid #4f46e5; border-radius: 6px; padding: 16px; margin-bottom: 20px;'>
                <p style='margin: 0 0 8px 0; font-weight: bold; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;'>Isi Pesan:</p>
                <div style='color: #1e293b; font-size: 15px;'>{$safeMessage}</div>
              </div>
              <p style='margin: 0; font-size: 12px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 14px;'>
                Email ini dikirimkan secara otomatis dari website portofolio Dhaffa Almuhar Dwi Setiawan. Anda dapat langsung membalas (Reply) email ini untuk menghubungi {$safeName}.
              </p>
            </div>
            ";

            // Plain text alternative
            $mail->AltBody = "Pesan Baru dari Formulir Kontak Portfolio\n"
                           . "========================================\n\n"
                           . "Nama Pengirim: {$name}\n"
                           . "Email Pengirim: {$email}\n"
                           . "Subjek: {$subject}\n\n"
                           . "Pesan:\n{$message}\n\n"
                           . "---\nBalas email ini langsung untuk merespons {$name} ({$email}).\n";

            $mail->send();

            // Show existing success message
            $successMessage = 'Terima kasih, ' . htmlspecialchars($name) . '! Pesan Anda telah diterima. Saya akan segera merespons email Anda.';

            // Reset fields after successful submission
            $name = '';
            $email = '';
            $subject = '';
            $message = '';
        } catch (Exception $e) {
            // Log technical error details
            error_log('PHPMailer Error: ' . $mail->ErrorInfo . ' | Exception: ' . $e->getMessage());
            $errorMessage = 'Pesan gagal dikirim. Silakan coba lagi atau hubungi via email langsung.';
        }
    }
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
