<?php
namespace setup\config;
use \setup\system\core\routerconf1;
use \setup\interface\appRouter;
use setup\system\di\dependencyinjector;


class routerv1 extends routerconf1 implements appRouter {
    public string $prefix = "";

    public function __construct(dependencyinjector $dependencyinjector)
    {
        parent::__construct($dependencyinjector);
    }

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
        $this->add($this->prefix,'POST', $path, $controller, $function, $middleware);
    }

    public function patch(string $path, string $controller, string $function, array $middleware = []):void{
        $this->add($this->prefix,'POST', $path, $controller, $function, $middleware);
    }

    public function delete(string $path, string $controller, string $function, array $middleware = []):void{
        $this->add($this->prefix,'POST', $path, $controller, $function, $middleware);
    }

    public function exec():void{
        $this->run();
    }
}