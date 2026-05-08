<?php
require_once __DIR__ . '/config.php';
session_start();

/* =========================
   LOGIN CONFIG
========================= */

/* =========================
   PROSES LOGIN
========================= */
if (isset($_POST['login'])) {
  $pdo = getPDO(true);
  if ($pdo) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
      $_SESSION['admin_logged'] = true;
      $_SESSION['admin_id'] = $user['id'];
      header('Location: admin.php');
      exit;
    } else {
      $error = 'Username atau password salah!';
    }
  } else {
    $error = 'Database tidak tersedia!';
  }
}

/* =========================
   LOGOUT
========================= */
if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: admin.php');
  exit;
}

/* =========================
   CEK LOGIN
========================= */
$logged = isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true;

/* =========================
   JIKA BELUM LOGIN
========================= */
if (!$logged):
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login Admin - WMH</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="container" style="max-width:400px;margin-top:5rem;">
  <h2>Login Admin</h2>

  <?php if (!empty($error)): ?>
    <p style="color:red"><?= $error ?></p>
  <?php endif; ?>

  <form method="post">
    <label>Username
    <input type="text" name="username" required></label>
    <label>Password
    <input type="password" name="password" required></label>
    <button type="submit" name="login" class="btn">Login</button>
  </form>
</main>
</body>
</html>
<?php
exit;
endif;

/* =========================
   ADMIN AREA
========================= */

// Clear appointments
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'clear') {
  $pdo = getPDO(true);
  if ($pdo) {
    $pdo->exec('TRUNCATE TABLE appointments');
  }
}

/* =========================
   FETCH DATA
========================= */
$pdo = getPDO(true);

// Janji
$appointments = [];
if ($pdo) {
  $appointments = $pdo->query(
    "SELECT * FROM appointments ORDER BY created_at DESC"
  )->fetchAll();
}

// Hasil Tes
$test_results = [];
if ($pdo) {
  $test_results = $pdo->query(
    "SELECT * FROM mental_test_results ORDER BY created_at DESC"
  )->fetchAll();
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin - WMH</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="site-header">
  <div class="container">
    <h1>WMH - Admin</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="test.php">Tes</a>
      <a href="appointment.php">Janji</a>
      <a href="articles.php">Artikel</a>
      <a href="admin.php?logout=1" style="color:red;">Logout</a>
    </nav>
  </div>
</header>

<main class="container">

<!-- ================= JANJI ================= -->
<h2>Daftar Janji Konsultasi</h2>

<form method="post" onsubmit="return confirm('Yakin akan mengosongkan semua janji?');">
  <input type="hidden" name="action" value="clear">
  <button type="submit" class="btn danger">Kosongkan Semua</button>
</form>

<?php if (empty($appointments)): ?>
  <p>Tidak ada janji.</p>
<?php else: ?>
<table class="appointments">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Email</th>
      <th>Tanggal</th>
      <th>Waktu</th>
      <th>Catatan</th>
      <th>Dibuat</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($appointments as $a): ?>
    <tr>
      <td><?= htmlspecialchars($a['name']) ?></td>
      <td><?= htmlspecialchars($a['email']) ?></td>
      <td><?= htmlspecialchars($a['date']) ?></td>
      <td><?= htmlspecialchars($a['time']) ?></td>
      <td><?= nl2br(htmlspecialchars($a['notes'])) ?></td>
      <td><?= htmlspecialchars($a['created_at']) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

<hr style="margin:3rem 0">

<!-- ================= HASIL TES ================= -->
<h2>Hasil Tes Kesehatan Mental Klien</h2>

<?php if (empty($test_results)): ?>
  <p>Belum ada klien yang mengerjakan tes.</p>
<?php else: ?>
<table class="appointments">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Total Skor</th>
      <th>Kategori</th>
      <th>Tanggal Tes</th>
    </tr>
  </thead>
  <tbody>
  <?php $no=1; foreach ($test_results as $r): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($r['nama']) ?></td>
      <td><?= htmlspecialchars($r['total_skor']) ?></td>
      <td><strong><?= htmlspecialchars($r['kategori']) ?></strong></td>
      <td><?= htmlspecialchars($r['created_at']) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

</main>

<footer>
  <div class="container">
    <p>&copy; WMH</p>
  </div>
</footer>

</body>
</html>
