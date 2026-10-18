<?php
/**
 * Projects Page View
 * 
 * Fetches and displays portfolio projects from PostgreSQL using PDO prepared statements.
 */

// Initialize variables
$projects = [];
$dbConnected = false;
$errorMessage = null;

// Query the projects table using PDO prepared statement
if (isset($pdo) && $pdo instanceof PDO) {
    try {
        $sql = "SELECT id, title, description, image_url, project_link, created_at FROM projects ORDER BY id ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbConnected = true;
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
    }
} else {
    $errorMessage = $dbError ?? 'PostgreSQL database connection could not be established. Please check your credentials in config/database.php.';
}

// Projects list remains empty until new projects are added to PostgreSQL
?>

<!-- Projects Header Banner -->
<section class="py-5 bg-white border-bottom">
  <div class="container py-3">
    <div class="row align-items-center gy-4">
      <div class="col-lg-8">
        <span class="text-primary fw-bold text-uppercase small tracking-wider">Portofolio</span>
        <h1 class="fw-extrabold display-5 mt-2 mb-2">Proyek Saya</h1>
        <p class="lead text-muted mb-0">
          Kumpulan aplikasi web dan eksplorasi backend development yang dibangun menggunakan native PHP dan PostgreSQL.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end">
        <?php if ($dbConnected): ?>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
            <i class="bi bi-database-check me-1"></i> PostgreSQL Terhubung (<?= count($projects) ?> proyek)
          </span>
        <?php else: ?>
          <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-pill">
            <i class="bi bi-info-circle me-1"></i> Database Offline
          </span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Database Status Banner / Diagnostic if needed -->
<?php if (!$dbConnected): ?>
<section class="pt-4">
  <div class="container">
    <div class="alert alert-warning border-warning-subtle rounded-4 shadow-sm p-4" role="alert">
      <div class="d-flex align-items-start gap-3">
        <div class="fs-3 text-warning">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="flex-grow-1">
          <h5 class="alert-heading fw-bold mb-1">PostgreSQL Setup Notice</h5>
          <p class="mb-2 small">
            Displaying demo project data. To connect to your live PostgreSQL database:
          </p>
          <ol class="small mb-2 ps-3">
            <li>Ensure your PostgreSQL server is active on <code>localhost:5432</code> (or configure credentials in <code>config/database.php</code>).</li>
            <li>Create the database: <code>CREATE DATABASE portfolio_db;</code></li>
            <li>Run the SQL script located at <code>database/database.sql</code> to create the <code>projects</code> table and seed the records.</li>
          </ol>
          <?php if (!empty($errorMessage)): ?>
            <details class="mt-2">
              <summary class="small text-muted fw-semibold" style="cursor: pointer;">View Connection Diagnostic Info</summary>
              <div class="p-2 mt-2 bg-light rounded text-monospace small font-mono text-danger border">
                <?= htmlspecialchars($errorMessage) ?>
              </div>
            </details>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Projects Grid Section -->
<section class="py-5">
  <div class="container">
    <?php if (empty($projects)): ?>
      <div class="row justify-content-center py-5">
        <div class="col-lg-8 col-md-10 text-center">
          <div class="card border-0 shadow-sm rounded-4 p-5 bg-white">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mx-auto mb-4" style="width: 84px; height: 84px;">
              <i class="bi bi-hourglass-split display-5"></i>
            </div>
            <h3 class="fw-bold mb-3 text-dark">Belum Ada Proyek</h3>
            <p class="lead text-muted mb-4 mx-auto" style="max-width: 520px;">
              Proyek pertama saya sedang dalam pengerjaan. Kembali lagi nanti!
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
              <a href="index.php?page=about" class="btn btn-outline-custom">
                <i class="bi bi-person me-1"></i> Tentang Saya
              </a>
              <a href="index.php?page=contact" class="btn btn-primary-custom">
                <i class="bi bi-envelope me-1"></i> Hubungi Saya
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="row g-4">
        <?php foreach ($projects as $project): ?>
          <div class="col-md-6 col-lg-4">
            <div class="project-card">
              <!-- Project Image / Preview -->
              <div class="project-img-wrapper">
                <img 
                  src="<?= htmlspecialchars($project['image_url'] ?? 'assets/img/project1.svg') ?>" 
                  alt="<?= htmlspecialchars($project['title']) ?>" 
                  class="project-card-img"
                  loading="lazy"
                  onerror="this.onerror=null; this.src='assets/img/project1.svg';"
                >
              </div>

              <!-- Project Body -->
              <div class="project-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="badge bg-primary-subtle text-primary border border-primary-subtle small">
                    #<?= htmlspecialchars($project['id']) ?> Proyek
                  </span>
                  <?php if (!empty($project['created_at'])): ?>
                    <span class="text-muted small">
                      <?= htmlspecialchars(date('M Y', strtotime($project['created_at']))) ?>
                    </span>
                  <?php endif; ?>
                </div>

                <h3 class="project-title fw-bold">
                  <?= htmlspecialchars($project['title']) ?>
                </h3>

                <p class="project-description">
                  <?= htmlspecialchars($project['description']) ?>
                </p>

                <!-- Project Action Button -->
                <div class="pt-3 border-top mt-auto">
                  <a 
                    href="<?= htmlspecialchars($project['project_link'] ?? '#') ?>" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="btn btn-sm btn-outline-custom w-100 d-flex align-items-center justify-content-center gap-2"
                  >
                    <span>Lihat Repository / Demo</span>
                    <i class="bi bi-arrow-up-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Projects Call to Action -->
<section class="py-5 bg-white border-top">
  <div class="container text-center py-4">
    <h3 class="fw-bold mb-2">Ingin berdiskusi atau berkolaborasi?</h3>
    <p class="text-muted mb-4">Mari terhubung untuk membicarakan pengembangan web atau bertukar pengalaman.</p>
    <a href="index.php?page=contact" class="btn btn-primary-custom">
      <i class="bi bi-chat-dots-fill me-1"></i> Hubungi Saya
    </a>
  </div>
</section>

