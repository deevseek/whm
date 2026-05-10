<?php
require_once __DIR__ . '/config.php';

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

$items = [];
$pdo = getPDO(true);
if ($pdo) {
    $items = $pdo->query('SELECT * FROM videos ORDER BY created_at DESC')->fetchAll();
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width,initial-scale=1" /><title>Video - WMH</title><link rel="stylesheet" href="assets/css/style.css" /></head><body><header class="site-header"><div class="container"><h1>WMH</h1><nav><a href="index.php">Home</a><a href="test.php">Tes Kesehatan Mental</a><a href="appointment.php">Buat Janji</a><a href="articles.php">Artikel</a><a href="videos.php">Video</a><a href="books.php">Buku</a><a href="admin.php">Admin</a></nav></div></header><main class="container"><h2>Video Edukasi Kesehatan Mental</h2><div class="video-grid"><?php foreach($items as $it): ?><div class="video"><iframe width="560" height="315" src="<?= htmlspecialchars(normalizeYoutubeEmbedUrl($it['embed_url'])) ?>" title="<?= htmlspecialchars($it['title']) ?>" frameborder="0" allowfullscreen></iframe><p><strong><?= htmlspecialchars($it['title']) ?></strong><br><?= htmlspecialchars($it['description']) ?></p></div><?php endforeach; ?></div></main></body></html>
