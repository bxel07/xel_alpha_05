<?php

namespace devise\Service;
use setup\baseclass\BaseServise;

class Service extends BaseServise {

    /**
     * @return void
     */
    public function index():void {
        $this->render('welcome');
    }
}