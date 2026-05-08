<?php
// Migration script: creates DB/tables and migrates appointments.json into MySQL
require_once __DIR__ . '/config.php';

echo "Starting migration...\n";

$pdo = getPDO(false); // connect without selecting DB to run CREATE DATABASE
if (!$pdo) {
    echo "Cannot connect to MySQL using provided credentials.\n";
    exit(1);
}

$schema = file_get_contents(__DIR__ . '/schema.sql');
try {
    // Execute statements in schema.sql (split by ;)
    $statements = array_filter(array_map('trim', explode(';', $schema)));
    foreach ($statements as $stmt) {
        if ($stmt === '') continue;
        $pdo->exec($stmt);
    }
    echo "Database and tables created/verified.\n";
} catch (PDOException $e) {
    echo "Error creating schema: " . $e->getMessage() . "\n";
    exit(1);
}

$db = getPDO(true);
if (!$db) {
    echo "Failed to connect to database after creation.\n";
    exit(1);
}

// Create default admin user if none exists
try {
    $stmt = $db->query('SELECT COUNT(*) AS c FROM users');
    $row = $stmt->fetch();
    if (empty($row) || intval($row['c']) === 0) {
        $defaultUser = 'admin';
        $defaultPass = 'admin123';
        $hash = password_hash($defaultPass, PASSWORD_DEFAULT);
        $ins = $db->prepare('INSERT INTO users (username, password_hash, created_at) VALUES (?, ?, ?)');
        $ins->execute([$defaultUser, $hash, date('Y-m-d H:i:s')]);
        echo "Default admin user created: username=admin password=admin123\n";
    } else {
        echo "Users table already has entries; skipping default admin creation.\n";
    }
} catch (PDOException $e) {
    echo "Error ensuring admin user: " . $e->getMessage() . "\n";
}

// Migrate appointments from JSON file
$jsonFile = __DIR__ . '/data/appointments.json';
if (file_exists($jsonFile)) {
    $json = file_get_contents($jsonFile);
    $items = json_decode($json, true) ?: [];
    if (!empty($items)) {
        $count = 0;
        $ins = $db->prepare('INSERT INTO appointments (name, email, date, time, notes, created_at) VALUES (?, ?, ?, ?, ?, ?)');
        foreach ($items as $a) {
            $ins->execute([
                $a['name'] ?? '',
                $a['email'] ?? '',
                $a['date'] ?? null,
                $a['time'] ?? null,
                $a['notes'] ?? null,
                isset($a['created_at']) ? date('Y-m-d H:i:s', strtotime($a['created_at'])) : date('Y-m-d H:i:s')
            ]);
            $count++;
        }
        echo "Migrated $count appointments to database.\n";
    } else {
        echo "No appointments found in JSON to migrate.\n";
    }
} else {
    echo "No JSON file found at $jsonFile.\n";
}

echo "Migration complete.\n";
