<?php
    /* Collection of helper to provide more usable function and easier to maintenance
        for file in Display folder
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



