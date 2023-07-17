<?php

namespace devise\Service;
use setup\config\xgen;
require_once __DIR__."/../../vendor/autoload.php";
class yogi
{
    protected $instance;
    public function __construct(){
        return $this->instance = new xgen();
    }

    public function store(string $table) {
        $data = $this->instance->show($table);
        var_dump($data);
    }

    public function storeById() {
        $data = $this->instance->showById("news", 4);
        var_dump($data);
    }

    public function create() {
        $insert = [
            "title" => "xelp",
            "content" => "xxel framework"
        ];

        return $this->instance->insert("news", $insert);
    }

    public function edit() {
        $insert = [
            "title" => "xeldoma",
            "content" => "xeldom framework"
        ];

        return $this->instance->renew("news",$insert,6);
    }

    public function delete() {
        return $this->instance->destroy("news", 4);
    }

}

$instance = new yogi();
/*show all data on database*/
//
//$instance->store("news");

/*show  data by id on database*/
//$instance->storeById();

/* insert  data  to database*/
//$instance->create();

/* update data  to database*/
//$instance->edit();

/* delete data  from database*/
//$instance->delete();
