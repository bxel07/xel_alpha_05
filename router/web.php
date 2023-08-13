<?php
require_once __DIR__.'/../vendor/autoload.php';

use setup\config\routerv1;
new setup\config\bootstrap();

/**
 * Router web implementation for traditional synchronous data transmission
 */

$router = new routerv1();
$router->setPrefix("web");

/**
 * Part of Gemstone Processor for getting the data
 */

$router->post('/GemstonePatch', datacatcher::class, 'index');

/**
 * Standard router prefix
 */
$router->get('/', Service::class, 'index');
$router->get('/test', Service::class,'test');
$router->get('/test1', Service::class,'test1');


$router->exec();
