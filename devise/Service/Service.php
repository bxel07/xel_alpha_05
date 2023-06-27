<?php

namespace devise\Service;
use devise\Basedata\Model;
use setup\baseclass\BaseData;
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Service{ 
    public function index() {
       //parrent class model 
       $instance = new Model();
       $instance->index();
       echo "Note Other things";
       //form model
    }

    public function test() {
         $instance = new BaseData();
         $instance->connect();
        echo "testing result";
    }
}