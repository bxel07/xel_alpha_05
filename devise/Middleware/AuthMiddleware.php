<?php

namespace devise\Middleware;
use setup\interface\appMiddleware;
use setup\security\Gems_Auth as auth;

class AuthMiddleware implements appMiddleware{

    private auth $auth;

    public function __construct(auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return void
     */
    public function before(): void
    {
        session_start();
        if(!isset($_SESSION['Gemstone_Auth_Token'])){
           $this->auth->redirect('/login');
        }

        if (!isset($_COOKIE['session_expiration']) || time() > (int)$_COOKIE['session_expiration']) {
           $this->auth->endSession();
        } else {
            $_COOKIE['session_expiration'];
        }

    }
}