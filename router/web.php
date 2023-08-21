<?php
require_once __DIR__.'/../vendor/autoload.php';

use setup\config\routerv1;
use setup\system\di\dependencyinjector;
new setup\config\bootstrap();

/**
 * Router web implementation for traditional synchronous data transmission with container based injector or constructor
 */

$container = new dependencyinjector();
$router = new routerv1($container);

/**
 * Setup Prefix for non Api Router
 */
$router->setPrefix("web");

/**
 * Part of Gemstone Processor for getting the data by default
 */

$router->post('/GemstonePatch', \devise\Service\Gemstone\datacatcher::class, 'index');
/**
 * Standard starter router prefix
 */
$router->get('/', \devise\Service\Service::class, 'index');

/**
 * Router auth prefix
 */

$router->get('/register', \devise\Service\Auth\Authentication::class, 'register');
$router->get('/login', \devise\Service\Auth\Authentication::class, 'login');
$router->get('/dologin', \devise\Service\Auth\Authentication::class, 'do_login');
$router->get('/doregister', \devise\Service\Auth\Authentication::class, 'do_register');


/**
 * Admin Dashboard Router
 */
$router->get('/auth/dashboard', \devise\Service\Dashboard\dashboard::class, 'index',[\devise\Middleware\AuthMiddleware::class]);
$router->post('/logout' , \devise\Service\Auth\Authentication::class, 'logout');
$router->exec();
