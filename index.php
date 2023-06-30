<?php
$path = filter_var($_SERVER['PATH_INFO'] ?? "/", FILTER_SANITIZE_URL);


if (str_starts_with($path, "/api/")) {
    require_once __DIR__."/router/api.php";
} elseif (preg_match("#^/[^/]*$#", $path)) {
    require_once __DIR__."/router/web.php";
} else {
    // Handle invalid paths or other scenarios
    echo "Invalid path";
    exit;
}



