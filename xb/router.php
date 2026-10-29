<?php
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$requestPath = '/' . trim($requestPath, '/');

if (PHP_SAPI === 'cli-server' && preg_match('/\.(?:png|jpe?g|gif|svg|ico|webp|css|js|woff2?)$/i', $requestPath)) {
    $documentRoot = realpath(__DIR__);
    $staticFile = realpath(__DIR__ . DIRECTORY_SEPARATOR . ltrim($requestPath, '/'));
    if ($documentRoot && $staticFile && is_file($staticFile) && strpos($staticFile, $documentRoot . DIRECTORY_SEPARATOR) === 0) {
        return false;
    }
}

$validRoutes = [
    '#^/$#',
    '#^/(games|blog|forums)$#',
    '#^/(game|blog)/[a-z0-9-]+$#',
    '#^/forum/[0-9]+$#',
];

$isValidRoute = false;
foreach ($validRoutes as $routePattern) {
    if (preg_match($routePattern, $requestPath)) {
        $isValidRoute = true;
        break;
    }
}

$dataFiles = [
    'games' => __DIR__ . '/data/games.json',
    'forums' => __DIR__ . '/data/forums.json',
    'blogs' => __DIR__ . '/data/blogs.json',
    'languages' => __DIR__ . '/data/languages.json',
    'core' => __DIR__ . '/data/core.json',
    'config' => __DIR__ . '/data/config.json',
];

try {
    $appData = [];
    foreach ($dataFiles as $key => $filePath) {
        $json = file_get_contents($filePath);
        if ($json === false) {
            throw new RuntimeException('Unable to read app data.');
        }

        $appData[$key] = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    }

    $appDataJson = json_encode(
        $appData,
        JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR
    );
    $template = file_get_contents(__DIR__ . '/layout.html');
    if ($template === false || !str_contains($template, '<!-- APP_DATA -->')) {
        throw new RuntimeException('Unable to load app template.');
    }
} catch (Throwable $error) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'No se pudo cargar el contenido del sitio.';
    exit;
}

http_response_code($isValidRoute ? 200 : 404);
header('Content-Type: text/html; charset=utf-8');
echo str_replace(
    '<!-- APP_DATA -->',
    '<script>window.APP_DATA = ' . $appDataJson . ';</script>',
    $template
);
