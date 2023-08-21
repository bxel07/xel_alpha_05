<?php

namespace setup\baseclass;
use setup\config\BaseConn;
use setup\config\xgen;
use setup\config\Display;

use Gemstone\main;
class BaseServise{
    protected \PDO $conn;

    protected main $descriptors;

    public function __construct(BaseConn $baseConn, main $descriptors) {
        $this->conn = $baseConn->getPDO();
        $this->descriptors = $descriptors;
    }

    public function render(string $path ='', array $data = [], string $name = ''): void
    {
        Display::render($path, $data, $name);
    }

    public function RedirectWithData(string $url, string $message = '', $data =[], int $statusCode = 302): void
    {
        Display::redirectWithMessage($url,$message, $data ,$statusCode);
    }

    public function redirect($url): void
    {
        Display::redirect($url);
    }

    public function query(): xgen
    {
        return new xgen();
    }


}