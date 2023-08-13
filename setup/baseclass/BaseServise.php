<?php

namespace setup\baseclass;
use setup\config\BaseConn;
use setup\config\xgen;
use setup\config\Display;

use Gemstone\main;
class BaseServise{
    protected $conn;

    protected $decrptor;

    public function __construct() {
        $conn = new BaseConn();
        $this->conn = $conn->getPDO();
        $this->decrptor = new main();
    }

    public function render(string $path ='', array $data = [], string $name = '') {
        Display::render($path, $data, $name);
        //echo $displayData->content;
    }

    public function redirect(string $url, string $message, $data, int $statusCode = 302) {
        Display::redirectWithMessage($url,$message, $data ,$statusCode);
    }

    public function xgen(): xgen
    {
        return new xgen();
    }


}