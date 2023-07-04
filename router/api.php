<?php
require_once __DIR__.'/../vendor/autoload.php';
use setup\config\routerv1;
new setup\config\bootstrap();

$routerv = new routerv1();

$routerv->setPrefix("api");
$routerv->get('/ono', Service::class, 'index');
$routerv->get('/dea/{id}', Service::class,'test');
$routerv->exec();
