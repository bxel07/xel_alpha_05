<?php
require_once __DIR__.'/../vendor/autoload.php';
<<<<<<< HEAD
use setup\config\Router;
use setup\middleware\Auth;
new setup\config\bootstrap();

$router = new Router();
$router->get('/', Service::class, 'index', [Auth::class]);
$router->get('/test', Service::class,'test');
$router->exec();
=======
use setup\config\routerv1;
new setup\config\bootstrap();

$routerv = new routerv1();

$routerv->setPrefix("web");

$routerv->get('/', Service::class, 'index');
$routerv->get('/hero/{id}', Service::class,'test');
$routerv->exec();

>>>>>>> 86bd6c789b60e2aada5debb0e831a04dc9256961
