<?php
require_once __DIR__.'/../vendor/autoload.php';
use setup\config\Router;
new setup\config\bootstrap();

$router = new Router();
$router->get('/', Service::class, 'index');
$router->get('/test', Service::class,'test');
$router->exec();