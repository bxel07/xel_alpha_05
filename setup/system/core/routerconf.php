<?php

namespace setup\system\core;

class routerconf{
    protected static array $routes = [];

    public static function setroute(string $lineprefix, string $method, string $path, string $controller, string $function, array $middleware = []): void {
        $config = require_once __DIR__.'/../../../setup/config/config.php';
        $x = $config['hello'];
        if (is_array($x)) {
            // The value is an array
            var_dump($x);
        } else {
            // The value is not an array
            echo "The returned value is not an array.";
        }


        // // for prefix helper
        // if ($lineprefix === $resultkey ) {
        //     $path = $data['web'].$path;
        //     echo $path;
        // } elseif ($lineprefix === $resultkey) {
        //     $path = $data['api'].$path;
        //     echo $path;
        // } else {
        //     echo "Error Prefix is illegal";
        // }
        if($controller[0] !== '\\') {
            $controller = '\\devise\\Service\\'. $controller;
        }

        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware
        ];
    }

    // main runner
    protected static function run(): void {
        $path = filter_var($_SERVER['PATH_INFO'] ?? "/");
        $method = $_SERVER['REQUEST_METHOD'];

        try {
            $route = self::matchRoute($path, $method);
            if ($route) {
                self::runMiddleware($route['middleware']);
                self::executeControllerMethod($route['controller'], $route['function'], $route['variables']);
            } else {
                throw new \Exception("Page not found");
            }
        } catch (\Exception $e) {
            echo 'Exception: ' . $e->getMessage();
        }
    }

    // Validating Pregmatch for routing
    protected static function matchRoute(string $path, string $method): ?array {
        foreach (self::$routes as $route) {
            $pattern = "#^" . preg_replace('/{(\w+)}/', '(?<$1>[^/]+)', $route['path']) . "$#";

            if (preg_match($pattern, $path, $variables) && $method === $route['method']) {
                $route['variables'] = $variables;
                return $route;
            }
        }

        return null;
    }

    // if available running instance of middleware
    protected static function runMiddleware(array $middleware): void {
        foreach ($middleware as $middlewareClass) {
            $instance = new $middlewareClass;
            $instance->before();
        }
    }

    // executing instance of controller
    protected static function executeControllerMethod(string $controllerClass, string $function, array $variables): void {
        if (class_exists($controllerClass) && method_exists($controllerClass, $function)) {
            $controller = new $controllerClass();
            $controller->$function($variables);
        }
    }

    // error handling pagenot found
    protected static function pageNotFound(): void {
        http_response_code(404);
        echo "Page not found";
    }

    public function prefix():void{
        $config = require __DIR__.'/../../config/config.php';
        echo "<pre>";
        print_r($config);
    }
}

$instance = new routerconf();
$instance->prefix();





