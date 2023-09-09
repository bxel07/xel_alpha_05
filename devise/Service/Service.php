<?php

namespace devise\Service;
use setup\baseclass\BaseServise;
use setup\config\http;
use setup\system\core\Router\AttributeCollections\Route;

class Service extends BaseServise {

    /**
     * @return void
     */

    #[Route(uri: '/',RequestMethod: http::GET)]
    public function index():void {
        $this->render('welcome');
    }

}