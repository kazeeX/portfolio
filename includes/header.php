<?php
/**
 * Header Template
 * 
 * Variables expected:
 * - $pageTitle (string): Title of current page
 * - $currentPage (string): Key for active navigation item ('home', 'about', 'projects', 'contact')
 */
$currentPage = $currentPage ?? 'home';
$pageTitle = $pageTitle ?? 'Portfolio';
$siteName = 'Dhaffa';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Portfolio Dhaffa Almuhar Dwi Setiawan - Pelajar Rekayasa Perangkat Lunak SMK Taruna Bangsa Kota Bekasi.">
  <meta name="author" content="Dhaffa Almuhar Dwi Setiawan">
  <title><?= htmlspecialchars($pageTitle) ?> | <?= htmlspecialchars($siteName) ?></title>

  <!-- Favicon icon -->
  <link rel="icon" type="image/svg+xml" href="assets/img/avatar.svg">

  <!-- Bootstrap 5 CDN CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-custom sticky-top py-3">
    <div class="container">
      <a class="navbar-brand" href="index.php?page=home">
        <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-2" style="width: 34px; height: 34px; font-size: 1rem;">
          <i class="bi bi-code-slash"></i>
        </span>
        <span class="fw-bold tracking-tight"><?= htmlspecialchars($siteName) ?></span>
      </a>

      <!-- Mobile Toggler -->
      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list fs-2"></i>
      </button>

      <!-- Nav Links -->
      <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">
          <li class="nav-item">
            <a class="nav-link <?= ($currentPage === 'home') ? 'active' : '' ?>" href="index.php?page=home">
              <i class="bi bi-house me-1"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($currentPage === 'about') ? 'active' : '' ?>" href="index.php?page=about">
              <i class="bi bi-person me-1"></i> About
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($currentPage === 'projects') ? 'active' : '' ?>" href="index.php?page=projects">
              <i class="bi bi-kanban me-1"></i> Projects
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($currentPage === 'contact') ? 'active' : '' ?>" href="index.php?page=contact">
              <i class="bi bi-envelope me-1"></i> Contact
            </a>
          </li>
          <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
            <a class="btn btn-sm btn-primary-custom" href="index.php?page=contact">
              <i class="bi bi-send-fill me-1"></i> Let's Talk
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content Wrapper -->
  <main>

