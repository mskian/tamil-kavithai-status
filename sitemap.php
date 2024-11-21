<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
header('Content-Type: application/xml');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? '';

if (empty($host)) {
    http_response_code(400);
    exit('Invalid Host');
}

$base_url = $protocol . '://' . $host;

if (!filter_var($base_url, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    exit('Invalid Base URL');
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ';
echo 'xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" ';
echo 'xmlns:xhtml="http://www.w3.org/1999/xhtml" ';
echo 'xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" ';
echo 'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" ';
echo 'xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . "\n";

$urls = [
    ['url' => '/', 'changefreq' => 'daily', 'priority' => '1.0'],
    ['url' => '/k/kavithai-1', 'changefreq' => 'weekly', 'priority' => '0.8'],
    ['url' => '/k/kavithai-2', 'changefreq' => 'monthly', 'priority' => '0.7'],
    ['url' => '/k/kavithai-4', 'changefreq' => 'monthly', 'priority' => '0.9'],
    ['url' => '/k/kavithai-6', 'changefreq' => 'daily', 'priority' => '0.9'],
];

foreach ($urls as $url) {
    if (!isset($url['url'], $url['changefreq'], $url['priority'])) {
        http_response_code(400);
        exit('Invalid Sitemap Data');
    }

    $url_loc = htmlspecialchars($base_url . $url['url'], ENT_QUOTES, 'UTF-8');
    $changefreq = htmlspecialchars($url['changefreq'], ENT_QUOTES, 'UTF-8');
    $priority = htmlspecialchars($url['priority'], ENT_QUOTES, 'UTF-8');

    echo "<url>\n";
    echo "<loc>$url_loc</loc>\n";
    echo "<changefreq>$changefreq</changefreq>\n";
    echo "<priority>$priority</priority>\n";
    echo "</url>\n";
}

echo '</urlset>' . "\n";

?>