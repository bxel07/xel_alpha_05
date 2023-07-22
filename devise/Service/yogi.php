<?php

namespace devise\Service;
use setup\config\xgen;

//handle request testing purpose only
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;

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

    public function handle() {
//        $request = ServerRequest::fromGlobals(); // Membuat objek request dari data superglobal PHP
//
//        // Menampilkan informasi request (contoh sederhana)
//        echo 'HTTP Method: ' . $request->getMethod() . '<br>';
//        echo 'URI: ' . $request->getUri() . '<br>';
//        echo 'Headers: <pre>' . print_r($request->getHeaders(), true) . '</pre>';
//        echo 'Query Params: <pre>' . print_r($request->getQueryParams(), true) . '</pre>';
//
//// Menanggapi request dengan response PSR-7
//        $response = new Response(200, ['Content-Type' => 'text/html'], 'Hello, PSR-7!');
//
//// Menampilkan informasi response (contoh sederhana)
//        echo 'Status Code: ' . $response->getStatusCode() . '<br>';
//        echo 'Headers: <pre>' . print_r($response->getHeaders(), true) . '</pre>';
//        echo 'Body: ' . $response->getBody();
    }
}

$instance = new yogi();
$instance->handle();
/*show all data on database*/
//
//$instance->store("news");

/*show  data by id on database*/
$instance->storeById();

/* insert  data  to database*/
//$instance->create();

/* update data  to database*/
//$instance->edit();

/* delete data  from database*/
//$instance->delete();
