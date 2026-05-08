<?php
require_once __DIR__ . '/config.php';

$saved = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $entry = [
    'name' => $_POST['name'] ?? '',
    'email' => $_POST['email'] ?? '',
    'date' => $_POST['date'] ?? null,
    'time' => $_POST['time'] ?? null,
    'notes' => $_POST['notes'] ?? '',
    'created_at' => date('Y-m-d H:i:s')
  ];

  // Try to save to database first
  $pdo = getPDO(true);
  if ($pdo) {
    try {
      $stmt = $pdo->prepare('INSERT INTO appointments (name, email, date, time, notes, created_at) VALUES (?, ?, ?, ?, ?, ?)');
      $stmt->execute([$entry['name'], $entry['email'], $entry['date'], $entry['time'], $entry['notes'], $entry['created_at']]);
      $saved = true;
    } catch (Exception $e) {
      // fallback to file storage
      $pdo = null;
    }
  }

  if (!$saved) {
    $dataFile = __DIR__ . '/data/appointments.json';
    $appointments = [];
    if (file_exists($dataFile)) {
      $json = file_get_contents($dataFile);
      $appointments = json_decode($json, true) ?? [];
    }
    $appointments[] = array_merge($entry, ['created_at' => date('c')]);
    file_put_contents($dataFile, json_encode($appointments, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $saved = true;
  }
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Buat Janji - WMH</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
  <header class="site-header">
    <div class="container">
      <h1>WMH</h1>
      <nav>
        <a href="index.php">Home</a>
        <a href="test.php">Tes Kesehatan Mental</a>
        <a href="appointment.php">Buat Janji</a>
        <a href="articles.php">Artikel</a>
        <a href="videos.php">Video</a>
        <a href="books.php">Buku</a>
        <a href="admin.php">Admin</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <h2>Buat Janji Konsultasi</h2>

    <?php if (!empty($saved)): ?>
      <div class="notice success">Terima kasih, janji Anda telah tersimpan.</div>
    <?php endif; ?>

    <form method="post" action="appointment.php">
      <label>Nama lengkap<br /><input type="text" name="name" required /></label>
      <label>Email<br /><input type="email" name="email" required /></label>
      <label>Tanggal<br /><input type="date" name="date" required /></label>
      <label>Waktu<br /><input type="time" name="time" required /></label>
      <label>Catatan (opsional)<br /><textarea name="notes"></textarea></label>
      <button type="submit" class="btn">Kirim</button>
    </form>

  </main>

  <footer>
    <div class="container">
      <p>&copy; WMH</p>
    </div>
  </footer>
</body>
</html>