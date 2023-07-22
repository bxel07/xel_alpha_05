<?php

namespace devise\Service;
use setup\baseclass\BaseService;

class Service extends BaseService{
    public function index() {
       $this->render('welcome');
    }
}