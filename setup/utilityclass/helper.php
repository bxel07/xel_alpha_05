<?php
// helper.php

function asset($path)
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $baseUrl = $protocol . $_SERVER['HTTP_HOST'];
    $basePath = dirname(__FILE__);

    // Sanitize the URL path
    $sanitizedPath = filter_var($path, FILTER_SANITIZE_URL);

    // Combine the base URL and sanitized path
    return rtrim($baseUrl, '/') . str_replace($basePath, '', $sanitizedPath);
}