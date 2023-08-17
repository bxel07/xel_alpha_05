<?php

namespace devise\Service\Auth;

use setup\baseclass\BaseServise;

class  Autenctication extends BaseServise {

    public function index() {
        echo "i am index auth";
        
    }


    public function register(): void
    {
        $this->render('Auths/register');
    }



    public function login() {
        $this->render('Auths/register');
    }


}
