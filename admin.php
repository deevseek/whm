<?php
require_once __DIR__ . '/config.php';
session_start();

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
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Login Admin</title><link rel="stylesheet" href="assets/css/style.css"></head><body><main class="container"><h2>Login Admin</h2><?php if (!empty($error)): ?><div class="notice"><?= htmlspecialchars($error) ?></div><?php endif; ?><form method="post"><label>Username<input name="username" required></label><label>Password<input type="password" name="password" required></label><button class="btn" name="login">Login</button></form></main></body></html>
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
        if ($action === 'create') $pdo->prepare('INSERT INTO videos (title,description,embed_url,created_at) VALUES (?,?,?,?)')->execute([$_POST['title'], $_POST['description'], $_POST['embed_url'], date('Y-m-d H:i:s')]);
        if ($action === 'update') $pdo->prepare('UPDATE videos SET title=?, description=?, embed_url=? WHERE id=?')->execute([$_POST['title'], $_POST['description'], $_POST['embed_url'], (int)$_POST['id']]);
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
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Admin CRUD WMH</title><link rel="stylesheet" href="assets/css/style.css"></head><body class="admin-page"><main class="container admin-panel"><h2>Dashboard CRUD</h2><p><a class="admin-logout-link" href="?logout=1">Logout</a></p>
<?php
function delForm($type, $id) { echo '<form method="post" class="admin-form-delete"><input type="hidden" name="crud_type" value="'.$type.'"><input type="hidden" name="crud_action" value="delete"><input type="hidden" name="id" value="'.$id.'"><button class="btn btn-danger">Hapus</button></form>'; }
?>
<section id="appointments" class="admin-section"><h3>🗓️ Kelola Janji</h3><form method="post" class="admin-form admin-form-create is-create"><input type="hidden" name="crud_type" value="appointments"><input type="hidden" name="crud_action" value="create"><input name="name" placeholder="Nama" required><input name="email" type="email" placeholder="Email" required><input name="date" type="date" required><input name="time" type="time" required><input name="notes" placeholder="Catatan"><button class="btn">Tambah</button></form><?php foreach($appointments as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="appointments"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="name" value="<?= htmlspecialchars($r['name']) ?>"><input name="email" value="<?= htmlspecialchars($r['email']) ?>"><input name="date" type="date" value="<?= $r['date'] ?>"><input name="time" type="time" value="<?= $r['time'] ?>"><input name="notes" value="<?= htmlspecialchars($r['notes']) ?>"><button class="btn">Simpan</button><?php delForm('appointments',$r['id']); ?></form><?php endforeach; ?></section>
<section id="results" class="admin-section"><h3>📊 Hasil Tes Mental</h3><?php foreach($results as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="results"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="nama" value="<?= htmlspecialchars($r['nama']) ?>"><input name="total_skor" type="number" value="<?= (int)$r['total_skor'] ?>"><input name="kategori" value="<?= htmlspecialchars($r['kategori']) ?>"><button class="btn">Simpan</button><?php delForm('results',$r['id']); ?></form><?php endforeach; ?></section>
<section id="articles" class="admin-section"><h3>📖 Kelola Artikel</h3><form method="post" class="admin-form admin-form-create is-create"><input type="hidden" name="crud_type" value="articles"><input type="hidden" name="crud_action" value="create"><input name="title" placeholder="Judul" required><input name="url" placeholder="URL"><input name="summary" placeholder="Ringkasan"><button class="btn">Tambah</button></form><?php foreach($articles as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="articles"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="title" value="<?= htmlspecialchars($r['title']) ?>"><input name="url" value="<?= htmlspecialchars($r['url']) ?>"><input name="summary" value="<?= htmlspecialchars($r['summary']) ?>"><button class="btn">Simpan</button><?php delForm('articles',$r['id']); ?></form><?php endforeach; ?></section>
<section id="books" class="admin-section"><h3>📚 Kelola Buku</h3><form method="post" class="admin-form admin-form-create is-create"><input type="hidden" name="crud_type" value="books"><input type="hidden" name="crud_action" value="create"><input name="title" placeholder="Judul" required><input name="author" placeholder="Penulis"><input name="url" placeholder="URL"><button class="btn">Tambah</button></form><?php foreach($books as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="books"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="title" value="<?= htmlspecialchars($r['title']) ?>"><input name="author" value="<?= htmlspecialchars($r['author']) ?>"><input name="url" value="<?= htmlspecialchars($r['url']) ?>"><button class="btn">Simpan</button><?php delForm('books',$r['id']); ?></form><?php endforeach; ?></section>
<section id="videos" class="admin-section"><h3>🎬 Kelola Video</h3><form method="post" class="admin-form admin-form-create is-create"><input type="hidden" name="crud_type" value="videos"><input type="hidden" name="crud_action" value="create"><input name="title" placeholder="Judul" required><input name="embed_url" placeholder="Embed URL" required><input name="description" placeholder="Deskripsi"><button class="btn">Tambah</button></form><?php foreach($videos as $r): ?><form method="post" class="admin-form is-row"><input type="hidden" name="crud_type" value="videos"><input type="hidden" name="crud_action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input name="title" value="<?= htmlspecialchars($r['title']) ?>"><input name="embed_url" value="<?= htmlspecialchars($r['embed_url']) ?>"><input name="description" value="<?= htmlspecialchars($r['description']) ?>"><button class="btn">Simpan</button><?php delForm('videos',$r['id']); ?></form><?php endforeach; ?></section>
</main></body></html>
