<?php
/**
 * Application Entry Point / Router
 * 
 * Routes incoming page requests using native PHP and includes header/footer templates.
 */

// Start session for flash messages (e.g. contact form submissions)
// NOTE: the hosting's default PHP session storage does not persist data
// between requests (verified 2026-10-21 — a value stored in the session
// was gone on the very next request, which broke CSRF token checks), so
// session files are stored in a private folder next to public_html.
// Falls back to the default storage if that folder is not usable.
if (session_status() === PHP_SESSION_NONE) {
    $sessionDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'sessions';
    if (!is_dir($sessionDir)) {
        @mkdir($sessionDir, 0700, true);
    }
    if (is_dir($sessionDir) && is_writable($sessionDir)) {
        session_save_path($sessionDir);
    }
    session_start();
}

// Load database configuration
require_once __DIR__ . '/config/database.php';

// Allowed page names for security whitelist
$allowedPages = [
    'home'     => [
        'file'  => 'home.php',
        'title' => 'Beranda - Portfolio Dhaffa'
    ],
    'about'    => [
        'file'  => 'about.php',
        'title' => 'Tentang Saya - Profil & Keahlian'
    ],
    'projects' => [
        'file'  => 'projects.php',
        'title' => 'Proyek - Portofolio Web Developer'
    ],
    'contact'  => [
        'file'  => 'contact.php',
        'title' => 'Kontak - Hubungi Dhaffa'
    ]
];

// Determine current page from query string, defaulting to 'home'
$currentPage = isset($_GET['page']) ? trim(strtolower($_GET['page'])) : 'home';

// Check if page exists in whitelist
if (!array_key_exists($currentPage, $allowedPages)) {
    http_response_code(404);
    $currentPage = '404';
    $pageTitle = '404 - Page Not Found';
    $pageFile = null;
} else {
    $pageTitle = $allowedPages[$currentPage]['title'];
    $pageFile = __DIR__ . '/pages/' . $allowedPages[$currentPage]['file'];
}

// Render Page
require_once __DIR__ . '/includes/header.php';

if ($pageFile && file_exists($pageFile)) {
    require_once $pageFile;
} else {
    // 404 Not Found fallback view
    ?>
    <section class="py-5 text-center">
      <div class="container py-5">
        <div class="display-1 fw-bold text-primary mb-3">404</div>
        <h2 class="fw-bold mb-3">Page Not Found</h2>
        <p class="text-muted mb-4 lead">The page you are looking for doesn't exist or has been moved.</p>
        <a href="index.php?page=home" class="btn btn-primary-custom">
          <i class="bi bi-house-door me-1"></i> Return Home
        </a>
      </div>
    </section>
    <?php
}

require_once __DIR__ . '/includes/footer.php';

