<?php
require_once __DIR__.'/../vendor/autoload.php';

use setup\config\routerv1;
use setup\middleware\Auth;
use setup\system\di\dependencyinjector;
new setup\config\bootstrap();

/**
 * Router web implementation for traditional synchronous data transmission with container based injector or constructor
 */

$container = new dependencyinjector();
$router = new routerv1($container);
$router->setPrefix("web");

/**
 * Part of Gemstone Processor for getting the data
 */

$router->post('/GemstonePatch', \devise\Service\Gemstone\datacatcher::class, 'index');
/**
 * Standard router prefix
 */

$router->get('/', \devise\Service\Service::class, 'index');
$router->get('/test', \devise\Service\Service::class,'test');
$router->get('/test1', \devise\Service\Service::class,'test1');

/**
 * Router auth prefix
 */

//$router->get('/dashboard', \Auth\Autenctication::class, 'index');
//$router->get('/register', \Auth\Autenctication::class, 'register');
//$router->get('/login', \Auth\Autenctication::class, 'login');

$router->exec();
