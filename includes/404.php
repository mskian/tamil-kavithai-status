<?php

/**
 * Handle and display a 404 error page with a custom message.
 *
 * @param string $message The error message to display.
 */
function showErrorPage(string $message): void
{
    // Validate server protocol
    $protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.0';
    if (!in_array($protocol, ['HTTP/1.0', 'HTTP/1.1', 'HTTP/2'], true)) {
        $protocol = 'HTTP/1.0';
    }

    // Send 404 HTTP response code and security headers
    header("$protocol 404 Not Found", true, 404);
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');
    header('X-Content-Type-Options: nosniff');
    header('Strict-Transport-Security: max-age=63072000; includeSubDomains');
    header('Referrer-Policy: no-referrer');

    // Sanitize the message
    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    // Render the 404 error page
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>404 - Not Found</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100..900&display=swap" rel="stylesheet">
        <style>
            body {
                margin: 0;
                font-family: 'Catamaran', sans-serif;
                background: linear-gradient(135deg, rgba(255, 120, 150, 0.8), rgba(255, 227, 67, 0.8));
                color: #333;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .error-container {
                text-align: center;
                background: #fff;
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                max-width: 600px;
            }
            .error-container h1 {
                font-size: 2.5rem;
                color: #e63946;
                margin-bottom: 1rem;
            }
            .error-container p {
                font-size: 1.2rem;
                margin: 1rem 0;
            }
            .error-container a {
                color: #007bff;
                text-decoration: none;
                font-weight: bold;
                font-size: 1rem;
            }
            .error-container a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>404 - Page Not Found</h1>
            <p>{$safeMessage}</p>
            <p><a href="/">Return to Homepage</a></p>
        </div>
    </body>
    </html>
    HTML;

    // Terminate script after displaying the error page
    exit;
}
