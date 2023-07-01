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
         $con  = $instance->connect();

         $con->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
         $stmt = $con->prepare("SELECT id, title, content FROM news");
         $stmt->execute();
         $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
         echo "<pre>";
         print_r($result);

        echo "testing result";
    }
}