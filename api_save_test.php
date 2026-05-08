<?php
// API endpoint untuk menyimpan hasil tes
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['score'], $data['category'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

$pdo = getPDO(true);
if (!$pdo) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO mental_test_results (nama, total_skor, kategori, created_at) VALUES (?, ?, ?, ?)');
    $stmt->execute([
        $data['nama'] ?? 'Anonymous',
        $data['score'],
        $data['category'],
        date('Y-m-d H:i:s')
    ]);
    
    echo json_encode(['success' => true, 'message' => 'Hasil tes tersimpan']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
