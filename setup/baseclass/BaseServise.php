<?php

namespace setup\baseclass;
use setup\config\BaseConn;
use setup\config\xgen;
use setup\config\Display;
class BaseServise{
    protected $conn;
    protected $render;
    public function __construct() {
        $conn = new BaseConn();
        $this->conn = $conn->getPDO();
    }

    public function render(string $path ='', array $data = [], string $name = '') {
        return Display::render($path,$data,$name);
    }

    public function xgen(): xgen
    {
        return new xgen();
    }

    public function Request(array $request){

    }

    public function Response(array $response) {

    }
}