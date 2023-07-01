<?php
namespace setup\config;
//use \setup\utilityclass\conf_router\RequestHandler;
use \setup\system\core\routerconf1;
use \setup\interface\appRouter;

class routerv1 extends routerconf1 implements appRouter {
    //use RequestHandler;
    public string $prefix = "";

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }
    public function get(string $path, string $controller, string $function, array $middleware = [], ):void{
        $this->add($this->prefix,'GET', $path, $controller, $function, $middleware);
    }

    public function post(string $path, string $controller, string $function, array $middleware = []):void{
        $this->add($this->prefix,'POST', $path, $controller, $function, $middleware);
    }

    public function put(string $path, string $controller, string $function, array $middleware = []):void{
        $this->add($this->prefix,'PUT', $path, $controller, $function, $middleware);
    }

    public function patch(string $path, string $controller, string $function, array $middleware = []):void{
        $this->add($this->prefix,'PATCH', $path, $controller, $function, $middleware);
    }

    public function delete(string $path, string $controller, string $function, array $middleware = []):void{
        $this->add($this->prefix,'DELETE', $path, $controller, $function, $middleware);
    }

    public function exec():void{
        $this->run();
    }
}