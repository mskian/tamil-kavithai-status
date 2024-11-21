<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Method Not Allowed');
}

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'];

if (!filter_var($base_url, FILTER_VALIDATE_URL)) {
    header('HTTP/1.1 400 Bad Request');
    exit('Invalid Base URL');
}

try {
    $robots_content = "User-agent: *\n";
    $robots_content .= "Disallow: /admin/\n";
    $robots_content .= "Disallow: /auth/\n";
    $robots_content .= "Disallow: /admin\n";
    $robots_content .= "Disallow: /auth\n";
    $robots_content .= "Disallow: /p\n";
    $robots_content .= "Disallow: /p/\n";

    $robots_content .= "\nUser-agent: NinjaBot\n";
    $robots_content .= "Allow: /\n";

    $robots_content .= "\nUser-agent: Mediapartners-Google*\n";
    $robots_content .= "Allow: /\n";

    $robots_content .= "\nUser-agent: Googlebot-Image\n";
    $robots_content .= "Allow: /\n";

    $robots_content .= "\nUser-agent: Adsbot-Google\n";
    $robots_content .= "Allow: /\n";
    
    $robots_content .= "\nUser-agent: Googlebot-Mobile\n";
    $robots_content .= "Allow: /\n";
    
    $robots_content .= "\nUser-agent: SemrushBot\n";
    $robots_content .= "Disallow: /\n";
    
    $robots_content .= "\nUser-agent: SemrushBot-SA\n";
    $robots_content .= "Disallow: /\n";
    
    $robots_content .= "\nUser-agent: AhrefsBot\n";
    $robots_content .= "Disallow: /\n";
    
    $robots_content .= "\nUser-agent: MJ12bot\n";
    $robots_content .= "Disallow: /\n";
    
    $robots_content .= "\nUser-agent: HTTrack\n";
    $robots_content .= "Disallow: /\n";

    $robots_content .= "\nSitemap: " . $base_url . "/sitemap.xml\n";

    echo $robots_content;
    
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    exit('Error generating robots.txt: ' . $e->getMessage());
}

?>