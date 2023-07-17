<?php
require_once __DIR__.'/../vendor/autoload.php';

use setup\config\Router;
use setup\middleware\Auth;
new setup\config\bootstrap();

$router = new Router();
$router->get('/', Service::class, 'index', [Auth::class]);
$router->get('/test', Service::class,'test');
$router->exec();
