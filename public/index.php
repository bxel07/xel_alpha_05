<?php
$path = filter_var($_SERVER['PATH_INFO'] ?? "/", FILTER_SANITIZE_URL);
if (str_starts_with($path, "/api/")) {
    require_once __DIR__ . "/router/api.php";
    exit();
} else {
    require_once __DIR__ . "/router/web.php";
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $baseUrl = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);

    $DATA = rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    var_dump($DATA);
    exit();
}


