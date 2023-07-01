<?php

namespace setup\system\core;

class routerconf1
{
    protected  array $routes = [];


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

        if($controller[0] !== '\\') {
            $controller = '\\devise\\Service\\'. $controller;
        }

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

    // executing instance of controller
    protected  function executeControllerMethod(string $controllerClass, string $function, array $variables): void {
        if (class_exists($controllerClass) && method_exists($controllerClass, $function)) {
            $controller = new $controllerClass();
            $controller->$function($variables);
        }
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
        $errorMessage = 'Exception: ' . $e->getMessage();
        $errorTrace = $e->getTraceAsString();

        $errorDetails = <<<EOD
        <strong>Error Details:</strong><br>
        Message: $errorMessage<br>
        Trace: <br>$errorTrace
    EOD;

        $errorGuide = <<<EOD
        <br><br>
        <strong>Fix Guide:</strong><br>
        1. Check if the necessary routes are properly defined in the router configuration.<br>
        2. Ensure that the middleware array is correctly assigned with the required middleware classes.<br>
        3. Verify that the controller and method specified in the route exist and are correctly defined.<br>
        4. Make sure that any dependencies or required files are properly included.<br>
        5. Double-check the request URL and HTTP method to ensure they match the defined routes.<br>
        6. Review the error message and stack trace for any additional clues to identify the issue.<br>
        7. If the error persists, consult the documentation or seek assistance from the development team.
    EOD;

        echo $errorDetails . $errorGuide;
        exit; // Add this line to prevent further execution after displaying the error and guide.
    }

}
