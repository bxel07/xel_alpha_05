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
        if(isset($_COOKIE['testing'])){
            setcookie('testing', $token);
        } else {
            $csrfToken = $_COOKIE['testing'];
        }

        echo "Success" . "<br />";
    }
}