<?php
// Script untuk memverifikasi dan memperbaiki database schema
require_once __DIR__ . '/config.php';

echo "=== Verifikasi Database Schema ===\n\n";

$pdo = getPDO(true);
if (!$pdo) {
    echo "❌ Tidak bisa connect ke database. Pastikan MySQL berjalan dan config.php benar.\n";
    exit(1);
}

// Check mental_test_results table
try {
    $stmt = $pdo->query("DESCRIBE mental_test_results");
    $columns = $stmt->fetchAll();
    $columnNames = array_map(function($col) { return $col['Field']; }, $columns);
    
    echo "✓ Tabel mental_test_results sudah ada\n";
    echo "  Kolom: " . implode(', ', $columnNames) . "\n";
    
    // Check if columns are correct
    $requiredColumns = ['id', 'nama', 'total_skor', 'kategori', 'created_at'];
    $missingColumns = array_diff($requiredColumns, $columnNames);
    
    if (!empty($missingColumns)) {
        echo "⚠ Kolom yang hilang: " . implode(', ', $missingColumns) . "\n";
        echo "\nMemperbaiki tabel...\n";
        
        // Drop and recreate table
        $pdo->exec("DROP TABLE mental_test_results");
        $schema = file_get_contents(__DIR__ . '/schema.sql');
        $statements = array_filter(array_map('trim', explode(';', $schema)));
        
        foreach ($statements as $stmt) {
            if (strpos($stmt, 'mental_test_results') !== false && $stmt !== '') {
                $pdo->exec($stmt);
                echo "✓ Tabel mental_test_results diperbaharui\n";
                break;
            }
        }
    }
} catch (PDOException $e) {
    echo "⚠ Tabel mental_test_results belum ada\n";
    echo "  Membuat tabel...\n";
    
    $schema = file_get_contents(__DIR__ . '/schema.sql');
    $statements = array_filter(array_map('trim', explode(';', $schema)));
    
    foreach ($statements as $stmt) {
        if (strpos($stmt, 'mental_test_results') !== false && $stmt !== '') {
            $pdo->exec($stmt);
            echo "✓ Tabel mental_test_results berhasil dibuat\n";
            break;
        }
    }
}

// Check appointments table
try {
    $stmt = $pdo->query("DESCRIBE appointments");
    echo "✓ Tabel appointments sudah ada\n";
} catch (PDOException $e) {
    echo "⚠ Tabel appointments tidak ada\n";
}

// Check users table
try {
    $stmt = $pdo->query("DESCRIBE users");
    $users = $pdo->query("SELECT COUNT(*) as count FROM users")->fetch();
    echo "✓ Tabel users sudah ada (" . $users['count'] . " pengguna)\n";
} catch (PDOException $e) {
    echo "⚠ Tabel users tidak ada\n";
}

echo "\n=== Verifikasi selesai ===\n";
