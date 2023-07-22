<?php
require_once __DIR__.'/../vendor/autoload.php';

use setup\config\routerv1;
use setup\middleware\Auth;
new setup\config\bootstrap();

$router = new routerv1();
$router->setPrefix("web");

//landing page
$router->get('/', Service::class, 'index');

//crud progam
$router->get('/posts', crud::class, 'index');             // Read - Show all items
$router->get('/show/{id}', crud::class, 'display'); // Read - Show a specific item
$router->get('/store', crud::class, 'iface_insert'); // Show the form to create an item
$router->post('/create', crud::class, 'insert');     // Create - Submit the form to create an item
$router->get('/edit/{id}', crud::class, 'iface_update'); // Show the form to update an item
$router->post('/update/{id}', crud::class, 'update'); // Update - Submit the form to update an item
$router->post('/delete/{id}', crud::class, 'drop'); // Delete - Submit the form to delete an item
$router->exec();
