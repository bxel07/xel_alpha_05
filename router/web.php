<?php
require_once __DIR__.'/../vendor/autoload.php';
use setup\config\router;
use setup\config\routerv1;
new setup\config\bootstrap();

//$router = new Router();
//
//$router->setPrefix("web");
//$router->get('/', Service::class, 'index');
//$router->get('/test', Service::class,'test');
//$router->exec();

$routerv1 = new routerv1();

$routerv1->setPrefix("api");
$routerv1->get('/', Service::class, 'index');
$routerv1->get('/test', Service::class,'test');
$routerv1->exec();