<?php
require_once __DIR__.'/../vendor/autoload.php';
use setup\config\routerv1;
new setup\config\bootstrap();

$routerv = new routerv1();

$routerv->setPrefix("web");
$routerv->get('/', Service::class, 'index');
$routerv->get('/test', Service::class,'test');
$routerv->exec();

