<?php

namespace setup\utilityclass\conf_router;

trait RequestHandler{
    private static array $routes = [];

    // main logic to controller method path for invoke and navigate url
    private static function add(string $method, string $path, string $controller, string $function, array $middleware = []): void {


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
    public static function run(): void {
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
    private static function matchRoute(string $path, string $method): ?array {
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
    private static function runMiddleware(array $middleware): void {
        foreach ($middleware as $middlewareClass) {
            $instance = new $middlewareClass;
            $instance->before();
        }
    }

    // executing instance of controller
    private static function executeControllerMethod(string $controllerClass, string $function, array $variables): void {
        if (class_exists($controllerClass) && method_exists($controllerClass, $function)) {
            $controller = new $controllerClass();
            $controller->$function($variables);
        }
    }

    // error handling pagenot found
    private static function pageNotFound(): void {
        http_response_code(404);
        echo "Page not found";
    }

}