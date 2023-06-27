<?php
namespace setup\config;
use \setup\utilityclass\conf_router\RequestHandler;
use \setup\interface\appRouter;

class router implements appRouter{
    use RequestHandler;

    public function get(string $path, string $controller, string $function, array $middleware = [], ):void{
        self::add('GET', $path, $controller, $function, $middleware);
    }

    public function post(string $path, string $controller, string $function, array $middleware = []):void{
        self::add('POST', $path, $controller, $function, $middleware);
    }

    public function put(string $path, string $controller, string $function, array $middleware = []):void{
        self::add('PUT', $path, $controller, $function, $middleware);
    }

    public function patch(string $path, string $controller, string $function, array $middleware = []):void{
        self::add('PATCH', $path, $controller, $function, $middleware);
    }

    public function delete(string $path, string $controller, string $function, array $middleware = []):void{
        self::add('DELETE', $path, $controller, $function, $middleware);
    }

    public function exec():void{
        self::run();
    }
}