<?php
/**
 * OLD Router
 */
// requiring global simple function
//require_once __DIR__ . '/../setup/utilityclass/helper.php';
//
//
//$path = filter_var($_SERVER['PATH_INFO'] ?? "/", FILTER_SANITIZE_URL);
//if (str_starts_with($path, "/api/")) {
//    require_once __DIR__."/../router/api.php";
//    exit();
//} else {
//    require_once __DIR__."/../router/web.php";
//    exit();
//}

/**
 * New Router
 */

// requiring global simple function
require_once __DIR__ . '/../setup/utilityclass/helper.php';
require_once __DIR__.'/../vendor/autoload.php';

use setup\system\core\Router\Router;
use setup\config\ClassLoader;
use setup\system\di\dependencyinjector;


$loadClasses = new ClassLoader();
$container = new dependencyinjector();
$router = new Router($container);

try {
    $router->SetClass($loadClasses->Load());
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    // Route the request based on the URI and HTTP method
    $route = $router->route($uri, $method);

    if ($route !== null) {
        [$className, $methodName] = $route;
        $instance = $router->InstanceLoader($className);

        $instance->$methodName();
        exit();
    } else {
        // Handle 404 Not Found if no matching route was found
        http_response_code(404);
        echo "404 Not Found";
    }

} catch (ReflectionException $e) {
    echo $e->getMessage();
}



