<?php

use devise\Service\Gemstone\datacatcher;
use setup\security\csrf_shielded;

require_once __DIR__.'/../../vendor/autoload.php';
/**
 * @param string $path
 * @return string
 * Shorthand function to including css or file on public directory
 */
function asset(string $path): string
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $baseurl = $protocol.$_SERVER['HTTP_HOST'];
    $basepath = dirname(__FILE__);

    //sanitize url
    $sanitizedpath = filter_var($path, FILTER_SANITIZE_URL);

    //combine base url with sanitized path
    return rtrim($baseurl, '/').str_replace($basepath,'',$sanitizedpath);
}

function route_post(string $data, string $param): string
{
    // Start the session
    session_start();

    // Set the same site attribute for the session cookie
    ini_set('session.cookie_samesite', 'Strict');

    // Capture output buffering

    // Your code to modify session data
    $x = explode('.', $data);
    $_SESSION['url_patch'] = htmlspecialchars($x[1], ENT_QUOTES, 'UTF-8');

    // param
    $_SESSION['param'] =htmlspecialchars($param, ENT_QUOTES, 'UTF-8');

    // Get and clean the output buffer

    // Close the session
    session_write_close();

    // Return the sanitized value
    return '/'.htmlspecialchars($x[0], ENT_QUOTES, 'UTF-8');

}

function getcsrf(): string
{
    $instance = new csrf_shielded();
    session_start();
        $data =$_SESSION['csrf'] = $instance->create_token();
    session_write_close();

    return "<input type='hidden' name='csrf_token' value='$data'>";

}

function method(string $method) {
    return "<input type='hidden' name='_method' value='$method'>";
}


