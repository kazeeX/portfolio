<?php
/**
 * Database Configuration & PDO Connection for PostgreSQL
 *
 * *** TEMPLATE — JANGAN taruh kredensial asli di sini ***
 *
 * Cara pakai:
 *   1. Copy file ini menjadi config/database.php
 *      (di Windows: copy, di Linux/Mac: cp config/database.example.php config/database.php)
 *   2. Isi DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS dengan kredensial asli.
 *   3. config/database.php sudah masuk .gitignore — tidak akan ke-push ke GitHub.
 *
 * Database: portfolio_db (lokal) / sesuaikan untuk hosting
 * Driver:   pdo_pgsql
 *
 * Catatan perbaikan (2026-10-20): parameter DSN
 * options='--client_encoding=UTF8' dihapus karena ditolak
 * PostgreSQL di server hosting ("invalid command-line argument").
 * Encoding UTF8 adalah default, jadi aman tanpa parameter itu.
 */

// Database credentials with environment variable fallback
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: '5432');
define('DB_NAME', getenv('DB_NAME') ?: 'portfolio_db');
define('DB_USER', getenv('DB_USER') ?: 'postgres');
define('DB_PASS', getenv('DB_PASS') ?: 'ganti-dengan-password-asli');

/**
 * Establishes and returns a PDO connection to PostgreSQL.
 *
 * @param string|null &$errorMessage Variable to capture error message if connection fails
 * @return PDO|null Returns PDO object on success, or null on failure
 */
function getDatabaseConnection(?string &$errorMessage = null): ?PDO {
    static $pdoInstance = null;

    if ($pdoInstance !== null) {
        return $pdoInstance;
    }

    $dsn = sprintf(
        'pgsql:host=%s;port=%s;dbname=%s',
        DB_HOST,
        DB_PORT,
        DB_NAME
    );

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_TIMEOUT            => 5,
    ];

    try {
        $pdoInstance = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdoInstance;
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        error_log('Database Connection Error: ' . $errorMessage);
        return null;
    }
}

// Global connection attempt for direct access
$dbError = null;
$pdo = getDatabaseConnection($dbError);
