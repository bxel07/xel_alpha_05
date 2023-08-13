<?php

namespace setup\system\core;

class routerconf{
    protected static array $routes = [];
    protected static string $prefixpath ="";

    // main logic to controller method path for invoke and navigate url
    protected static function add(string $prefix, string $method, string $path, string $controller, string $function, array $middleware = []): void {

        $data = self::prefix();
        $x = $data["web"];
        $y = $data["api"];

        if(strcmp($prefix,"web")){
            self::$prefixpath =$x.$path;
        }elseif (strcmp($prefix,"api")) {
            self::$prefixpath =$y.$path;
        }
        else {
            echo "error prefix must";
        }

        if($controller[0] !== '\\') {
            $controller = '\\devise\\Service\\'. $controller;
        }


        self::$routes[] = [
            'method' => $method,
            'path' => self::$prefixpath,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware
        ];
        echo "<pre>";
        //var_dump(self::$routes);
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

    // prefix
    protected static function prefix():array{
        $config = require __DIR__."/../../config/config.php";
        $test = $config["Prefix"];
        $web = $test["web"];
        $api = $test["api"];
        return [
            "web" => $web,
            "api" => $api
        ];
    }
}






