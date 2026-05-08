<?php
// Database configuration for WMH demo
// Default XAMPP MySQL credentials: user `root` with empty password
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'teman');
define('DB_USER', 'root');
define('DB_PASS', '');

function getPDO($withDb = true)
{
    $host = DB_HOST;
    $user = DB_USER;
    $pass = DB_PASS;
    $dsn = 'mysql:host=' . $host . ($withDb ? ';dbname=' . DB_NAME : '') . ';charset=utf8mb4';
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}

function dbAvailable()
{
    return getPDO(true) !== null;
}
