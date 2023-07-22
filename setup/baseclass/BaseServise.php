<?php

namespace setup\baseclass;
use setup\config\BaseConn;
class BaseServise{
    protected $conn;

    public function __construct() {
        $conn = new BaseConn();
        $this->conn = $conn->getPDO();
    }

    public function render():void {

    }

    public function Request(array $request){

    }

    public function Response(array $response) {

    }
}