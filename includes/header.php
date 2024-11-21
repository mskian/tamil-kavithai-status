<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');

function getFullUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    return rtrim($protocol . $host . $scriptName, '/'); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#c7ecee">

    <title>தமிழ் கவிதை Status</title>
    <meta name="description" content="தமிழ் கவிதை நிலை - இங்கே நான் எனது பிடித்த தமிழ் பொன்மொழிகளையும் கவிதைகளையும் பகிர்கிறேன்."/>
    <?php $current_page = htmlspecialchars("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", ENT_QUOTES, 'UTF-8');
        echo '<link rel="canonical" href="' . $current_page . '" />';
    ?>


    <link rel="shortcut icon" type="image/x-icon" href="<?php echo getFullUrl() . '/favicon.ico'; ?>" />
    <link rel="icon" type="image/png" sizes="196x196" href="<?php echo getFullUrl() . '/196.png'; ?>" />
    <link rel="apple-touch-icon" href="<?php echo getFullUrl() . '/180.png'; ?>" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="application-name" content="Kavithai" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Kavithai" />

    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css" integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo getFullUrl() . '/assets/css/style.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<nav class="navbar is-fixed-top">
    <div class="navbar-brand is-flex is-justify-content-center is-flex-grow-1">
        <a class="navbar-item" href="/">
            <img src="<?php echo getFullUrl() . '/60.png'; ?>" alt="Tamil status" loading="lazy">
        </a>
    </div>
</nav>
<div class="container" style="margin-top: 80px;">
<div class="content">