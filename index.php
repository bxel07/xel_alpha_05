<?php
$path = filter_var($_SERVER['PATH_INFO'] ?? "/", FILTER_SANITIZE_URL);
if (str_starts_with($path, "/api/")) {
    require_once __DIR__."/router/api.php";
    exit();
} else {
    require_once __DIR__."/router/web.php";
    exit();
}



