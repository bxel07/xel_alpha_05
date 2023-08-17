<?php

namespace setup\system\core;

use setup\system\di\dependencyinjector;

class routerconf1
{
    protected  array $routes = [];
    protected dependencyinjector $container;

    public function __construct(dependencyinjector $dependencyinjector)
    {
        $this->container = $dependencyinjector;
    }

    // main logic to controller method path for invoke and navigate url
    protected  function add(string $prefix, string $method, string $path, string $controller, string $function, array $middleware = []): void {

        $data = $this->prefix();
        $x = $data["web"];
        $y = $data["api"];

        $prefixpath = '';
        if(strcmp($prefix,"web")===0){
            $prefixpath = $x ;
        } elseif (strcmp($prefix,"api")===0) {
            $prefixpath = $y ;

        } else {
            echo "error prefix must setup";
        }

        $fullPath = $prefixpath . $path;

//        if($controller[0] !== 'd') {
//            $controller = '\\devise\\Service\\'. $controller;
//        }elseif ($controller[0] === 'd') {
//            $controller = '\\devise\\Service\\Gemstone\\'. $controller;
//        }

        $this->routes[] = [
            'method' => $method,
            'path' => $fullPath,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware
        ];
    }

    // main runner
    protected function run(): void {
        $path = filter_var($_SERVER['PATH_INFO'] ?? "/", FILTER_SANITIZE_URL);
        $method = $_SERVER['REQUEST_METHOD'];

        try {
            $route = $this->matchRoute($path, $method);
            if ($route) {
                $this->runMiddleware($route['middleware']);
                $this->executeControllerMethod($route['controller'], $route['function'], $route['variables']);
            } else {
                throw new \Exception("Page not found");
            }
        } catch (\Exception $e) {
            $this->handleError($e);
        }
        exit();
    }

    // Validating Pregmatch for routing
    protected  function matchRoute(string $path, string $method): ?array {
        foreach ($this->routes as $route) {
            $pattern = "#^" . preg_replace('/{(\w+)}/', '(?<$1>[^/]+)', $route['path']) . "$#";
            if (preg_match($pattern, $path, $variables) && $method === $route['method']) {
                $route['variables'] = $variables;
                return $route;
            }
        }

        return null;
    }

    // if available running instance of middleware
    protected  function runMiddleware(array $middleware): void {
        foreach ($middleware as $middlewareClass) {
            $instance = new $middlewareClass;
            $instance->before();
        }
    }

    // executing instance of controller based container injector

    /**
     * @throws \ReflectionException
     */
    protected  function executeControllerMethod(string $controllerClass, string $function, array $variables): void {
        if (class_exists($controllerClass) && method_exists($controllerClass, $function)) {
            $controller = $this->createControllerInstance($controllerClass);
            $controller->$function($variables);
        }
    }

    /**
     * @throws \ReflectionException
     */
    protected function createControllerInstance(string $controllerClass)
    {
        $reflectionClass = new \ReflectionClass($controllerClass);
        $constructor = $reflectionClass->getConstructor();

        if (!empty($controllerClass)) {
            $dependencies = [];
            $constructorParameters = $constructor->getParameters();

            foreach ($constructorParameters as $parameter) {
                $parameterClass = $parameter->getType();
                if($parameterClass !== null) {
                    $dependency = $this->container->get($parameterClass->getName());
                    $dependencies[] = $dependency;
                }
            }
        }
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    // error handling pagenot found
    protected  function pageNotFound(): void {
        http_response_code(404);
        echo "Page not found";
    }

    // prefix
    protected function prefix():array{
        $config = require __DIR__."/../../config/config.php";
        $test = $config["Prefix"];
        $web = $test["web"];
        $api = $test["api"];
        return [
            "web" => $web,
            "api" => $api
        ];
    }

    protected function handleError(\Exception $e): void
    {
        $errorDetails = "An error occurred while processing your request. Please try again later.";

        $errorGuide = <<<EOD
            <br><br>
            <strong>Fix Guide:</strong><br>
            If you continue to experience issues, please contact our support team for assistance.
        EOD;

        echo $errorDetails . $errorGuide;
        exit;
    }
}
