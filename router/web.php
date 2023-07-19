<?php
require_once __DIR__.'/../vendor/autoload.php';

use setup\config\routerv1;
use setup\middleware\Auth;
new setup\config\bootstrap();

$router = new routerv1();
$router->setPrefix("web");

$router->get('/', Service::class, 'index', [Auth::class]);
$router->get('/test', Service::class,'test');
$router->get('/data', yogi::class,'handle');
$router->exec();
