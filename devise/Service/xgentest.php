<?php

    namespace devise\Service;
    use setup\baseclass\BaseServise;
    require_once __DIR__."/../../vendor/autoload.php";

    class xgentest extends BaseServise{

        //start building select all function

        public function getdata($table) {
            $data = $this->xgen()->show($table);
            //echo data
            echo "<pre>";
            print_r($data);
        }

        //make select by id
        public function selectid($table,$id) {
            $data = $this->xgen()->showById($table,$id);
            echo "<pre>";
            print_r($data);
        }
    }

// make instance to run function
//$instance = new xgentest();
//    $instance->getdata('news');
//$instance->selectid('news',14);

