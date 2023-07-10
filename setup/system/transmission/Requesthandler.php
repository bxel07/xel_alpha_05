<?php

namespace setup\system\transmission;
use GuzzleHttp\Psr7\Request;
require_once __DIR__."/../../../vendor/autoload.php";
class  Requesthandler{



    //Main Driver
    public function driver() {
        $request = new Request('GET','http://localhost:8000/hero/1');
        $header = ['X-Foo' => 'Bar'];
        $body = 'hello!';
    }


    //GET
    public function solve_GET() {

    }
    //POST

    public function solve_POST() {

    }

    //UPDATE
    public function solve_UPDATE() {

    }

    //DELETE

    public function solve_DELETE() {

    }
}
