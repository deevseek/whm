<?php
// set_admin_password.php
// Usage (CLI): php set_admin_password.php [newpassword]
// Usage (web): http://localhost/kesmen/set_admin_password.php?password=newpassword
// Default password if not provided: mujib123

require_once __DIR__ . '/config.php';

$default = 'mujib123';
$password = $default;

if (PHP_SAPI === 'cli') {
    global $argv;
    if (isset($argv[1]) && !empty($argv[1])) {
        $password = $argv[1];
    }
} else {
    if (isset($_GET['password']) && $_GET['password'] !== '') {
        $password = $_GET['password'];
    }
}

$pdo = getPDO(true);
if (!$pdo) {
    $msg = "Database tidak tersedia. Pastikan MySQL berjalan dan `config.php` dikonfigurasi.\n";
    if (PHP_SAPI === 'cli') {
        echo $msg; exit(1);
    } else {
        echo '<pre>' . htmlspecialchars($msg) . '</pre>'; exit;
    }
}

$username = 'admin';
$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user) {
        $upd = $pdo->prepare('UPDATE users SET password_hash = ? WHERE username = ?');
        $upd->execute([$hash, $username]);
        $out = "Password untuk pengguna 'admin' telah diperbarui.\n";
    } else {
        $ins = $pdo->prepare('INSERT INTO users (username, password_hash, created_at) VALUES (?, ?, ?)');
        $ins->execute([$username, $hash, date('Y-m-d H:i:s')]);
        $out = "Pengguna 'admin' dibuat dengan password yang diberikan.\n";
    }
} catch (PDOException $e) {
    $out = "Terjadi kesalahan database: " . $e->getMessage() . "\n";
}

// Output and security note
if (PHP_SAPI === 'cli') {
    echo $out;
    echo "Disarankan untuk menghapus file 'set_admin_password.php' setelah perubahan.\n";
} else {
    echo '<pre>' . htmlspecialchars($out) . "\nDisarankan untuk menghapus file 'set_admin_password.php' setelah perubahan." . '</pre>';
}
