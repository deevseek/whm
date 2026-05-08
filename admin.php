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
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login Admin - WMH</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      width: 100%;
      height: 100%;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      position: relative;
      overflow: hidden;
    }

    /* Animated background circles */
    body::before {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      top: -100px;
      left: -100px;
      animation: float 20s infinite ease-in-out;
    }

    body::after {
      content: '';
      position: absolute;
      width: 300px;
      height: 300px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50%;
      bottom: -50px;
      right: -50px;
      animation: float 25s infinite ease-in-out reverse;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(30px); }
    }

    .login-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 420px;
      padding: 20px;
    }

    .login-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      padding: 60px 40px;
      animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .login-logo {
      font-size: 60px;
      margin-bottom: 20px;
      display: block;
    }

    .login-title {
      font-size: 32px;
      font-weight: 700;
      color: #333;
      margin: 0 0 8px 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .login-subtitle {
      font-size: 14px;
      color: #999;
      margin: 0;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-size: 14px;
      font-weight: 600;
      color: #333;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-group label .icon {
      font-size: 18px;
    }

    .form-group input {
      padding: 14px 16px;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      font-size: 15px;
      font-family: inherit;
      transition: all 0.3s ease;
      background: #f8f9fa;
    }

    .form-group input:focus {
      outline: none;
      border-color: #667eea;
      background: white;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-group input::placeholder {
      color: #aaa;
    }

    .error-message {
      background: #fee;
      border: 2px solid #fcc;
      color: #c33;
      padding: 14px 16px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: shake 0.5s ease;
    }

    .error-message::before {
      content: '⚠️';
      font-size: 18px;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }

    .login-button {
      padding: 14px 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .login-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 25px rgba(102, 126, 234, 0.4);
    }

    .login-button:active {
      transform: translateY(0);
    }

    .login-footer {
      text-align: center;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #e0e0e0;
      font-size: 13px;
      color: #999;
    }

    .login-footer a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }

    .login-footer a:hover {
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .login-card {
        padding: 40px 24px;
      }

      .login-title {
        font-size: 24px;
      }

      .login-logo {
        font-size: 48px;
      }

      body::before {
        width: 250px;
        height: 250px;
      }

      body::after {
        width: 200px;
        height: 200px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <span class="login-logo">🧠</span>
        <h1 class="login-title">WMH</h1>
        <p class="login-subtitle">Website Mental Health - Admin Login</p>
      </div>

      <?php if (!empty($error)): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="post" class="login-form">
        <div class="form-group">
          <label for="username">
            <span class="icon">👤</span>
            Username
          </label>
          <input type="text" id="username" name="username" placeholder="Masukkan username" required autofocus>
        </div>

        <div class="form-group">
          <label for="password">
            <span class="icon">🔐</span>
            Password
          </label>
          <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" name="login" class="login-button">🔓 Masuk ke Dashboard</button>
      </form>

      <div class="login-footer">
        Default: username <strong>admin</strong> | password <strong>admin123</strong>
      </div>
    </div>
  </div>
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
  <title>Admin Dashboard - WMH</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
      background: #f5f7fa;
      color: #333;
    }

    body {
      min-height: 100vh;
    }

    .admin-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 20px 40px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .admin-header-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1400px;
      margin: 0 auto;
    }

    .admin-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 24px;
      font-weight: 700;
    }

    .admin-brand .logo {
      font-size: 32px;
    }

    .admin-nav {
      display: flex;
      gap: 30px;
      align-items: center;
    }

    .admin-nav a {
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .admin-nav a:hover {
      color: white;
    }

    .admin-nav a.logout {
      background: rgba(255, 255, 255, 0.2);
      padding: 8px 16px;
      border-radius: 8px;
      color: white;
    }

    .admin-nav a.logout:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    .admin-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 40px;
    }

    .admin-section {
      background: white;
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .section-title {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 25px;
      color: #333;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .section-title::before {
      content: '';
      width: 4px;
      height: 28px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 2px;
    }

    .action-buttons {
      display: flex;
      gap: 12px;
      margin-bottom: 25px;
    }

    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 14px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-danger {
      background: #ff6b6b;
      color: white;
    }

    .btn-danger:hover {
      background: #ee5a52;
      transform: translateY(-2px);
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #999;
    }

    .empty-state-icon {
      font-size: 60px;
      margin-bottom: 15px;
    }

    .empty-state p {
      font-size: 16px;
      margin: 0;
    }

    .table-wrapper {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    table thead {
      background: #f8f9fa;
      border-bottom: 2px solid #e6ebf6;
    }

    table th {
      padding: 16px;
      text-align: left;
      font-weight: 700;
      color: #333;
    }

    table td {
      padding: 16px;
      border-bottom: 1px solid #e6ebf6;
      word-break: break-word;
    }

    table tbody tr:hover {
      background: #f8f9fa;
    }

    .table-number {
      font-weight: 700;
      color: #667eea;
    }

    .table-category {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: 600;
      font-size: 12px;
    }

    .category-low {
      background: #d4edda;
      color: #155724;
    }

    .category-medium {
      background: #fff3cd;
      color: #856404;
    }

    .category-high {
      background: #f8d7da;
      color: #721c24;
    }

    .category-very-high {
      background: #f5c6cb;
      color: #721c24;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 25px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
    }

    .stat-number {
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .stat-label {
      font-size: 14px;
      opacity: 0.9;
    }

    .divider {
      height: 1px;
      background: linear-gradient(90deg, transparent, #e6ebf6, transparent);
      margin: 40px 0;
    }

    @media (max-width: 768px) {
      .admin-header-content {
        flex-direction: column;
        gap: 20px;
        text-align: center;
      }

      .admin-nav {
        flex-direction: column;
        gap: 12px;
        width: 100%;
      }

      .admin-container {
        padding: 20px;
      }

      .admin-section {
        padding: 20px;
      }

      .section-title {
        font-size: 20px;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      table {
        font-size: 12px;
      }

      table th, table td {
        padding: 12px;
      }
    }
  </style>
</head>
<body>

<header class="admin-header">
  <div class="admin-header-content">
    <div class="admin-brand">
      <span class="logo">🧠</span>
      <span>WMH Admin Dashboard</span>
    </div>
    <nav class="admin-nav">
      <a href="index.php">🏠 Home</a>
      <a href="test.php">📝 Tes</a>
      <a href="appointment.php">📅 Janji</a>
      <a href="articles.php">📖 Artikel</a>
      <a href="admin.php?logout=1" class="logout">🚪 Logout</a>
    </nav>
  </div>
</header>

<main class="admin-container">
  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-number"><?= count($appointments) ?></div>
      <div class="stat-label">📅 Total Janji</div>
    </div>
    <div class="stat-card">
      <div class="stat-number"><?= count($test_results) ?></div>
      <div class="stat-label">📊 Hasil Tes</div>
    </div>
  </div>

  <!-- ================= JANJI ================= -->
  <section class="admin-section">
    <h2 class="section-title">📅 Daftar Janji Konsultasi</h2>

    <div class="action-buttons">
      <form method="post" onsubmit="return confirm('Yakin akan mengosongkan semua janji?');" style="margin: 0;">
        <input type="hidden" name="action" value="clear">
        <button type="submit" class="btn btn-danger">🗑️ Kosongkan Semua Janji</button>
      </form>
    </div>

    <?php if (empty($appointments)): ?>
      <div class="empty-state">
        <div class="empty-state-icon">📭</div>
        <p>Belum ada janji konsultasi</p>
      </div>
    <?php else: ?>
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Catatan</th>
              <th>Dibuat</th>
            </tr>
          </thead>
          <tbody>
          <?php $no = 1; foreach ($appointments as $a): ?>
            <tr>
              <td><span class="table-number"><?= $no++ ?></span></td>
              <td><?= htmlspecialchars($a['name']) ?></td>
              <td><?= htmlspecialchars($a['email']) ?></td>
              <td><?= htmlspecialchars($a['date']) ?></td>
              <td><?= htmlspecialchars($a['time']) ?></td>
              <td><?= nl2br(htmlspecialchars($a['notes'])) ?: '-' ?></td>
              <td><?= htmlspecialchars($a['created_at']) ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>

  <div class="divider"></div>

  <!-- ================= HASIL TES ================= -->
  <section class="admin-section">
    <h2 class="section-title">📊 Hasil Tes Kesehatan Mental</h2>

    <?php if (empty($test_results)): ?>
      <div class="empty-state">
        <div class="empty-state-icon">📝</div>
        <p>Belum ada klien yang mengerjakan tes</p>
      </div>
    <?php else: ?>
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Total Skor</th>
              <th>Kategori</th>
              <th>Tanggal Tes</th>
            </tr>
          </thead>
          <tbody>
          <?php $no = 1; foreach ($test_results as $r): ?>
            <tr>
              <td><span class="table-number"><?= $no++ ?></span></td>
              <td><?= htmlspecialchars($r['nama'] ?? 'Anonymous') ?></td>
              <td><strong><?= htmlspecialchars($r['total_skor']) ?></strong></td>
              <td>
                <span class="table-category category-<?php 
                  $kat = strtolower($r['kategori']);
                  echo ($kat === 'rendah' ? 'low' : ($kat === 'sedang' ? 'medium' : ($kat === 'tinggi' ? 'high' : 'very-high')));
                ?>">
                  <?= htmlspecialchars($r['kategori']) ?>
                </span>
              </td>
              <td><?= htmlspecialchars($r['created_at']) ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>
</main>

<footer style="text-align: center; padding: 30px 40px; background: #f5f7fa; color: #999; margin-top: 40px; border-top: 1px solid #e6ebf6;">
  <p>&copy; 2026 WMH - Website Mental Health. Semua hak dilindungi.</p>
</footer>

</body>
</html>
