<?php
require_once __DIR__ . '/config.php';
session_start();

function normalizeYoutubeEmbedUrl(string $url): string {
    $url = trim($url);
    if ($url === '') return '';

    $parts = parse_url($url);
    if (!$parts || empty($parts['host'])) return $url;

    $host = strtolower($parts['host']);
    $path = $parts['path'] ?? '';
    parse_str($parts['query'] ?? '', $query);

    $videoId = '';
    if (in_array($host, ['youtu.be'], true)) {
        $videoId = trim($path, '/');
    } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com'], true)) {
        if (strpos($path, '/embed/') === 0) {
            return $url;
        }
        if ($path === '/watch' && !empty($query['v'])) {
            $videoId = $query['v'];
        } elseif (strpos($path, '/shorts/') === 0 || strpos($path, '/live/') === 0) {
            $videoId = basename($path);
        }
    }

    if ($videoId !== '') {
        return 'https://www.youtube.com/embed/' . rawurlencode($videoId);
    }

    return $url;
}

if (isset($_POST['login'])) {
    $pdo = getPDO(true);
    if ($pdo) {
        $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$_POST['username'] ?? '']);
        $user = $stmt->fetch();
        if ($user && password_verify($_POST['password'] ?? '', $user['password_hash'])) {
            $_SESSION['admin_logged'] = true;
            $_SESSION['admin_id'] = $user['id'];
            header('Location: admin.php');
            exit;
        }
    }
    $error = 'Username atau password salah / DB tidak tersedia.';
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

if (empty($_SESSION['admin_logged'])): ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="admin-login-page">
  <div class="admin-login-bubble admin-login-bubble--top"></div>
  <div class="admin-login-bubble admin-login-bubble--bottom"></div>

  <main class="admin-login">
    <section class="admin-login__card">
      <div class="admin-login__logo" aria-hidden="true">🧠</div>
      <h1>WMH</h1>
      <p>Website Mental Health - Admin Login</p>

      <?php if (!empty($error)): ?>
      <div class="notice admin-login__notice"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="post" class="admin-login__form">
        <label for="admin-username">👤 Username</label>
        <input id="admin-username" name="username" placeholder="Masukkan username" required>

        <label for="admin-password">🔒 Password</label>
        <input id="admin-password" type="password" name="password" placeholder="Masukkan password" required>

        <button class="btn admin-login__btn" name="login" type="submit">🔐 Masuk ke Dashboard</button>
      </form>

      <div class="admin-login__default">Default: username <strong>admin</strong> | password <strong>admin123</strong></div>
    </section>
  </main>
</body>
</html>
<?php exit; endif;

$pdo = getPDO(true);
if (!$pdo) { die('Database tidak tersedia'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crud_type'], $_POST['crud_action'])) {
    $type = $_POST['crud_type'];
    $action = $_POST['crud_action'];
    if ($type === 'appointments') {
        if ($action === 'create') {
            $pdo->prepare('INSERT INTO appointments (name,email,date,time,notes,created_at) VALUES (?,?,?,?,?,?)')->execute([$_POST['name'], $_POST['email'], $_POST['date'], $_POST['time'], $_POST['notes'], date('Y-m-d H:i:s')]);
        } elseif ($action === 'update') {
            $pdo->prepare('UPDATE appointments SET name=?, email=?, date=?, time=?, notes=? WHERE id=?')->execute([$_POST['name'], $_POST['email'], $_POST['date'], $_POST['time'], $_POST['notes'], (int)$_POST['id']]);
        } elseif ($action === 'delete') {
            $pdo->prepare('DELETE FROM appointments WHERE id=?')->execute([(int)$_POST['id']]);
        }
    }
    if ($type === 'results') {
        if ($action === 'update') {
            $pdo->prepare('UPDATE mental_test_results SET nama=?, total_skor=?, kategori=? WHERE id=?')->execute([$_POST['nama'], (int)$_POST['total_skor'], $_POST['kategori'], (int)$_POST['id']]);
        } elseif ($action === 'delete') {
            $pdo->prepare('DELETE FROM mental_test_results WHERE id=?')->execute([(int)$_POST['id']]);
        }
    }
    if ($type === 'articles') {
        if ($action === 'create') $pdo->prepare('INSERT INTO articles (title,summary,url,created_at) VALUES (?,?,?,?)')->execute([$_POST['title'], $_POST['summary'], $_POST['url'], date('Y-m-d H:i:s')]);
        if ($action === 'update') $pdo->prepare('UPDATE articles SET title=?, summary=?, url=? WHERE id=?')->execute([$_POST['title'], $_POST['summary'], $_POST['url'], (int)$_POST['id']]);
        if ($action === 'delete') $pdo->prepare('DELETE FROM articles WHERE id=?')->execute([(int)$_POST['id']]);
    }
    if ($type === 'books') {
        if ($action === 'create') $pdo->prepare('INSERT INTO books (title,author,url,created_at) VALUES (?,?,?,?)')->execute([$_POST['title'], $_POST['author'], $_POST['url'], date('Y-m-d H:i:s')]);
        if ($action === 'update') $pdo->prepare('UPDATE books SET title=?, author=?, url=? WHERE id=?')->execute([$_POST['title'], $_POST['author'], $_POST['url'], (int)$_POST['id']]);
        if ($action === 'delete') $pdo->prepare('DELETE FROM books WHERE id=?')->execute([(int)$_POST['id']]);
    }
    if ($type === 'videos') {
        $embedUrl = normalizeYoutubeEmbedUrl($_POST['embed_url'] ?? '');
        if ($action === 'create') $pdo->prepare('INSERT INTO videos (title,description,embed_url,created_at) VALUES (?,?,?,?)')->execute([$_POST['title'], $_POST['description'], $embedUrl, date('Y-m-d H:i:s')]);
        if ($action === 'update') $pdo->prepare('UPDATE videos SET title=?, description=?, embed_url=? WHERE id=?')->execute([$_POST['title'], $_POST['description'], $embedUrl, (int)$_POST['id']]);
        if ($action === 'delete') $pdo->prepare('DELETE FROM videos WHERE id=?')->execute([(int)$_POST['id']]);
    }
    header('Location: admin.php#' . $type);
    exit;
}

$appointments = $pdo->query('SELECT * FROM appointments ORDER BY created_at DESC')->fetchAll();
$results = $pdo->query('SELECT * FROM mental_test_results ORDER BY created_at DESC')->fetchAll();
$articles = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC')->fetchAll();
$books = $pdo->query('SELECT * FROM books ORDER BY created_at DESC')->fetchAll();
$videos = $pdo->query('SELECT * FROM videos ORDER BY created_at DESC')->fetchAll();
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Admin CRUD WMH</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body class="admin-page">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="admin-sidebar__brand">WMH Admin</div>
    <nav class="admin-sidebar__nav" id="admin-sidebar-nav">
      <a href="#appointments" data-section="appointments">🗓️ Janji</a><a href="#results" data-section="results">📊 Hasil Tes</a><a href="#articles" data-section="articles">📖 Artikel</a><a href="#books" data-section="books">📚 Buku</a><a href="#videos" data-section="videos">🎬 Video</a>
    </nav>
    <a class="admin-sidebar__logout" href="?logout=1">Logout</a>
  </aside>
  <main class="container admin-panel"><h2>Dashboard Admin</h2>
<?php
function delForm($type, $id) { echo '<form method="post" class="admin-form-delete"><input type="hidden" name="crud_type" value="'.$type.'"><input type="hidden" name="crud_action" value="delete"><input type="hidden" name="id" value="'.$id.'"><button class="btn btn-danger">Hapus</button></form>'; }
?>
<section id="appointments" class="admin-section"><h3>🗓️ Kelola Janji</h3><form method="post" class="admin-form admin-form-create is-create"><input type="hidden" name="crud_type" value="appointments"><input type="hidden" name="crud_action" value="create"><input name="name" placeholder="Nama" required><input name="email" type="email" placeholder="Email" required><input name="date" type="date" required><input name="time" type="time" required><input name="notes" placeholder="Catatan"><button class="btn">Tambah</button></form><?php foreach($appointments as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="appointments"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="name" value="<?= htmlspecialchars($r['name']) ?>"><input name="email" value="<?= htmlspecialchars($r['email']) ?>"><input name="date" type="date" value="<?= $r['date'] ?>"><input name="time" type="time" value="<?= $r['time'] ?>"><input name="notes" value="<?= htmlspecialchars($r['notes']) ?>"><button class="btn">Simpan</button><?php delForm('appointments',$r['id']); ?></form><?php endforeach; ?></section>
<section id="results" class="admin-section"><h3>📊 Hasil Tes Mental</h3><?php foreach($results as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="results"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="nama" value="<?= htmlspecialchars($r['nama']) ?>"><input name="total_skor" type="number" value="<?= (int)$r['total_skor'] ?>"><input name="kategori" value="<?= htmlspecialchars($r['kategori']) ?>"><button class="btn">Simpan</button><?php delForm('results',$r['id']); ?></form><?php endforeach; ?></section>
<section id="articles" class="admin-section"><h3>📖 Kelola Artikel</h3><form method="post" class="admin-form admin-form-create is-create"><input type="hidden" name="crud_type" value="articles"><input type="hidden" name="crud_action" value="create"><input name="title" placeholder="Judul" required><input name="url" placeholder="URL"><input name="summary" placeholder="Ringkasan"><button class="btn">Tambah</button></form><?php foreach($articles as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="articles"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="title" value="<?= htmlspecialchars($r['title']) ?>"><input name="url" value="<?= htmlspecialchars($r['url']) ?>"><input name="summary" value="<?= htmlspecialchars($r['summary']) ?>"><button class="btn">Simpan</button><?php delForm('articles',$r['id']); ?></form><?php endforeach; ?></section>
<section id="books" class="admin-section"><h3>📚 Kelola Buku</h3><form method="post" class="admin-form admin-form-create is-create"><input type="hidden" name="crud_type" value="books"><input type="hidden" name="crud_action" value="create"><input name="title" placeholder="Judul" required><input name="author" placeholder="Penulis"><input name="url" placeholder="URL"><button class="btn">Tambah</button></form><?php foreach($books as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="books"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="title" value="<?= htmlspecialchars($r['title']) ?>"><input name="author" value="<?= htmlspecialchars($r['author']) ?>"><input name="url" value="<?= htmlspecialchars($r['url']) ?>"><button class="btn">Simpan</button><?php delForm('books',$r['id']); ?></form><?php endforeach; ?></section>
<section id="videos" class="admin-section"><h3>🎬 Kelola Video</h3><form method="post" class="admin-form admin-form-create is-create"><input type="hidden" name="crud_type" value="videos"><input type="hidden" name="crud_action" value="create"><input name="title" placeholder="Judul" required><input name="embed_url" placeholder="Embed URL" required><input name="description" placeholder="Deskripsi"><button class="btn">Tambah</button></form><?php foreach($videos as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="videos"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="title" value="<?= htmlspecialchars($r['title']) ?>"><input name="embed_url" value="<?= htmlspecialchars($r['embed_url']) ?>"><input name="description" value="<?= htmlspecialchars($r['description']) ?>"><button class="btn">Simpan</button><?php delForm('videos',$r['id']); ?></form><?php endforeach; ?></section>
</main></div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var sections = Array.from(document.querySelectorAll('.admin-section'));
  var navLinks = Array.from(document.querySelectorAll('#admin-sidebar-nav a[data-section]'));

  function showSection(sectionId) {
    var activeId = sectionId || 'appointments';

    sections.forEach(function (section) {
      var isActive = section.id === activeId;
      section.classList.toggle('admin-section--active', isActive);
      section.classList.toggle('admin-section--hidden', !isActive);
    });

    navLinks.forEach(function (link) {
      var isActiveLink = link.dataset.section === activeId;
      link.classList.toggle('is-active', isActiveLink);
      if (isActiveLink) {
        link.setAttribute('aria-current', 'page');
      } else {
        link.removeAttribute('aria-current');
      }
    });
  }

  function getSectionFromHash() {
    var rawHash = window.location.hash.replace('#', '');
    return navLinks.some(function (link) { return link.dataset.section === rawHash; }) ? rawHash : 'appointments';
  }

  showSection(getSectionFromHash());

  navLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      showSection(link.dataset.section);
    });
  });

  window.addEventListener('hashchange', function () {
    showSection(getSectionFromHash());
  });
});
</script>
</body></html>
