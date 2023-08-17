<?php
namespace setup\middleware;
use setup\interface\appMiddleware;
use setup\system\http\MiddlewareHttp;

class Auth implements appMiddleware {
    public function before(): void
    {
        $getToken = new MiddlewareHttp();
        $token = $getToken->getToken();

        session_start();
        //setup in cookie
        if (!isset($_COOKIE['csrf'])){
            $getToken->setCookie('csrf', $token, time() + 86400, '/', '', false, true, ['SameSite' => 'Strict']);
            header('Set-Cookie: csrf=' . $token . '; SameSite=Strict; Secure');
        } else {
            $csrfToken = $_COOKIE['csrf'];
        }

        if(isset($_POST['csrf'])) {
            if(hash_equals( $_COOKIE['csrf'] , $_POST['csrf'])){
                unset($_COOKIE['csrf']);
                setcookie('csrf', '', time() - 3600, '/', '', false, true);

            } else {
                unset($_COOKIE['csrf']);
                setcookie('csrf', '', time() - 3600, '/', '', false, true);
            }
        }

        var_dump($_COOKIE['csrf']);
        session_write_close();
    }
}