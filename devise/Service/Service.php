<?php

namespace devise\Service;
use setup\baseclass\BaseServise;
use setup\config\http;
use setup\system\core\Router\AttributeCollections\Route;

class Service extends BaseServise {

    /**
     * @return void
     */

    #[]
    #[Route(uri: '/',RequestMethod: http::GET)]
    public function index():void {
        $this->render('welcome');
    }
    #[Route(uri: '/test', RequestMethod: http::GET)]
    public function test(): void
    {
        $this->render('redirect');
    }

    #[Route(uri: '/test1', RequestMethod: http::GET)]
    public function test1(): void
    {
        var_dump($this->requestHandler->request());
        $this->requestHandler->secure_data();

    }

    #[Route(uri: '/forGet', RequestMethod: http::GET)]
    public function forGET():void {
        echo "Success Using Get Request";
    }

    #[Route(uri: '/forPOST', RequestMethod: http::POST)]
    public function forPOST():void {
        echo "Success Using POST Request";
    }
    #[Route(uri: '/forPUT', RequestMethod: http::PUT)]
    public function forPUT():void {
        echo "Success Using PUT Request";
    }
    #[Route(uri: '/forDELETE', RequestMethod: http::DELETE)]
    public function forDELETE():void {
        echo "Success Using DELETE Request";
    }


}