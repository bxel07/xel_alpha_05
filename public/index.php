<?php
/**
 * Requiring Global Helper
 */
require_once __DIR__ . '/../setup/utilityclass/helper.php';
require_once __DIR__.'/../vendor/autoload.php';

use setup\system\core\Router\Router;
use setup\config\ClassLoader;
use setup\system\di\DependencyInjector;

$loadClasses = new ClassLoader();
$container = new DependencyInjector();
$router = new Router($container);

try {
    $router->SetClass($loadClasses->Load());
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    // Route the request based on the URI and HTTP method
    $route = $router->route($uri, $method);

    if ($route !== null) {
        foreach ($route as $key => $value) {
            $className = $value['className'];
            $methodName = $value['methodName'];
            $params = $value['params'];
            $middleware = $value['Middleware'];

            $router->MiddlewareLoader($middleware);
            $instance = $router->InstanceLoader($className);

            call_user_func_array([$instance, $methodName], [$params]);
        }
        exit();
    } else {
        // Handle 404 Not Found if no matching route was found
        http_response_code(404);
        echo "404 Not Found";
    }

} catch (ReflectionException $e) {
    echo $e->getMessage();
}



