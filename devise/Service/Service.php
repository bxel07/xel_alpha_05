<?php

namespace devise\Service;
use devise\Basedata\Model;
use setup\baseclass\BaseData;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Service{
    public function index() {
       //parrent class model
       $instance = new Model();
       $instance->index();
       echo "Note Other things";
       //form model
    }

    public function test(array $variables = []) {
//         $instance = new BaseData();
//         $con  = $instance->connect();
//
//         $con->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
//         $stmt = $con->prepare("SELECT id, title, content FROM news");
//         $stmt->execute();
//         $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//         echo "<pre>";
//         print_r($result);
//         echo "testing result";
        $id = $variables['id'];
        echo $id;
    }
}