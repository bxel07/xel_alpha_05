<?php

namespace setup\system\core\Router;
use Generator;
use ReflectionClass;
use ReflectionException;
use setup\system\core\Router\AttributeCollections\Route;
use setup\system\di\DependencyInjector;

class Router
{
    private array $Routes = [];
    private string $RouterGroupPrefix ='default';
    private int|bool $RouterGroupStatus = false;
    private array $middlewareGroup = [];
    private array $ClassWrapper;

    public function __construct(
        protected DependencyInjector $DependencyInjector
    )
    {}

    /**
     * @throws ReflectionException
     */
    public function SetClass(array $ClassWrapper): void
    {
        $this->ClassWrapper = $ClassWrapper;
        $this->getMethodMetadata();
    }

    /**
     * @throws ReflectionException
     */
    public function getMethodMetadata(): void
    {
        foreach ($this->ClassWrapper as $wrapper){
            $reflection = new ReflectionClass($wrapper);
            $this->loadAttributeClass($wrapper);
            $methods = $reflection->getMethods();
            foreach ($methods as $method) {
                    $attributes = $method->getAttributes(Route::class);
                    foreach ($attributes as $attribute) {
                        $getAttributeInstance = $attribute->newInstance();
                        $methodName = $method->getName();
                        $TmpData = [
                            'Uri' =>  $this->RouterGroupStatus ? $this->RouterGroupPrefix . $getAttributeInstance->uri : $getAttributeInstance->uri ,
                            'VRoute' => $getAttributeInstance->VRoute,
                            'RequestMethod'=> $getAttributeInstance->RequestMethod,
                            'Middleware' => $this->RouterGroupStatus ? $this->middlewareGroup :$getAttributeInstance->Middleware,
                            'Class' => $wrapper,
                            'MethodName' => $methodName
                        ];
                        $this->Routes[] = $TmpData;
                    }
            }
        }
    }

    /**
     * @param $uri
     * @param $method
     * @return array|Generator|null
     */
    public function route($uri ,$method): array|Generator|null
    {
//        echo "<pre>";
//        print_r($this->Routes);
//        echo "</pre>";
        foreach ($this->Routes as $route) {
            $routeUri = $route['Uri'];
            if (isset($route['RequestMethod'])){
                $extractUri = $this->RouteMatch($uri, $routeUri);
                if($extractUri !== null) {
                    $className = $route['Class'];
                    $methodName = $route['MethodName'];
                    $middleware = $route['Middleware'];

                    if($method !== $route['RequestMethod']) {
                        if($route['RequestMethod'] === $_POST['_method']) {
                            if (class_exists($className)) {
                                return yield [
                                    'className' => $className,
                                    'methodName'=>$methodName,
                                    'Middleware' =>$middleware,
                                    'params' => $extractUri,
                                ];
                            }
                        }
                    } else {
                        if (class_exists($className)) {
                            return yield [
                                'className' => $className,
                                'methodName'=>$methodName,
                                'Middleware' =>$middleware,
                                'params' => $extractUri
                            ];
                        }
                    }
                }

            }
        }
    }

    private function RouteMatch(string $uri, string $routeUri):?array {
        $pattern = preg_replace('/\/{([^\/]+)}/', '/(?<$1>[a-zA-Z0-9\-_.]+)', $routeUri);
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        // Check if the URI matches the pattern
        if (preg_match($pattern, $uri, $matches)) {
            // Extract dynamic parameters from the matched URI
            $params = [];
            foreach ($matches as $key => $value) {
                if (!is_numeric($key)) {
                    $params[$key] = $value;
                }
            }
            return $params;
        }
        return null;
    }

    /**
     * @throws ReflectionException
     */
    private function loadAttributeClass(string $class):void
    {
        $reflection = new ReflectionClass($class);
        $loop = $reflection->getAttributes();
        foreach ($loop as $value) {
                $instance = $value->newInstance();
                $this->RouterGroupStatus = $instance->status;
                $this->RouterGroupPrefix = $instance->prefix;
                $this->middlewareGroup = $instance->middleware;
        }
    }

    public function MiddlewareLoader(array $middleware):void
    {
        $i = 0;
        while ($i < count($middleware)) {
            $class = new $middleware[$i];
            $class->before();
            $i++;
        }
    }

    /**
     * @throws ReflectionException
     */
    public function InstanceLoader(string $class) {
        $reflectionClass = new ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();
        $dependencies = [];
        if (!empty($class)) {
            $constructorParameters = $constructor->getParameters();
            foreach ($constructorParameters as $parameter) {
                $parameterClass = $parameter->getType();
                if($parameterClass !== null) {
                    $dependency = $this->DependencyInjector->get($parameterClass->getName());
                    $dependencies[] = $dependency;
                }
            }
        }
        return $reflectionClass->newInstanceArgs($dependencies);
    }
}