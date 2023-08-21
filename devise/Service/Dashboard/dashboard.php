<?php

namespace devise\Service\Dashboard;

use setup\baseclass\BaseServise;

class dashboard extends BaseServise
{
    public function index() {
        $this->render('Auths/dasboard/dashboard');
    }
}