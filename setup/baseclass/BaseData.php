<?php 
namespace setup\baseclass;
use setup\config\BaseConn;
class BaseData{
    public function test() {
        echo "hello world";
    }

    public function connect() {
        $con = new BaseConn();
        return $con->getPDO();
    }
}
