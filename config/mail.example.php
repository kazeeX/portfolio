<?php
/**
 * SMTP Mail Configuration - EXAMPLE TEMPLATE (PHPMailer via Gmail)
 *
 * Cara pakai:
 * 1. Copy file ini menjadi config/mail.php
 * 2. Isi SMTP_USER dan SMTP_PASS dengan kredensial asli kamu
 *
 * File config/mail.php yang asli TIDAK ikut di-push ke GitHub (ada di .gitignore).
 */

// SMTP Server Configuration
define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_PORT', (int)(getenv('SMTP_PORT') ?: 587));
define('SMTP_SECURE', getenv('SMTP_SECURE') ?: 'tls');
define('SMTP_AUTH', true);

// SMTP Credentials - isi dengan data asli di config/mail.php
define('SMTP_USER', getenv('SMTP_USER') ?: 'your-email@gmail.com');
define('SMTP_PASS', getenv('SMTP_PASS') ?: 'YOUR_16_CHAR_APP_PASSWORD');

// Notification Recipient Email
define('MAIL_TO_ADDRESS', getenv('MAIL_TO_ADDRESS') ?: 'your-email@gmail.com');
define('MAIL_TO_NAME', getenv('MAIL_TO_NAME') ?: 'Your Name');
