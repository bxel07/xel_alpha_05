<?php

namespace setup\system\core\Router;
use ReflectionClass;
use ReflectionException;
use setup\system\core\Router\AttributeCollections\Route;
use setup\system\di\dependencyinjector;

class Router
{
    private array $Routes = [];

    private array $VRoutes = [];

    private bool|int $DebugMode = 1;

    private array $ClassWrapper;


    public function __construct(protected dependencyinjector $DependencyInjector)
    {

    }

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
            $methods = $reflection->getMethods();
            foreach ($methods as $method) {
                $attributes = $method->getAttributes(Route::class);


                foreach ($attributes as $attribute) {
                    $getAttributeInstance = $attribute->newInstance();
                    $methodName = $method->getName();
                    $TmpData = [
                        'Uri' => $getAttributeInstance->uri,
                        'VRoute' => $getAttributeInstance->VRoute,
                        'RequestMethod'=> $getAttributeInstance->RequestMethod,
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
     * @return array|null
     * @throws ReflectionException
     */
    public function route($uri ,$method): ?array
    {
        foreach ($this->Routes as $route) {
            $routeUri = $route['Uri'];
            if ($routeUri === $uri && isset($route['RequestMethod'])) {
                $className = $route['Class'];
                $methodName = $route['MethodName'];

                if($method !== $route['RequestMethod']) {
                    if($route['RequestMethod'] === $_POST['_method']) {
                        if (class_exists($className)) {
                            $instance = new $className();
                            if (method_exists($instance, $methodName)) {
                                return [$className, $methodName];
                            }
                        }
                    }
                } else {
                    if (class_exists($className)) {
                        $instance =   $this->InstanceLoader($className)  ;  //new $className();
                        if (method_exists($instance, $methodName)) {
                            return [$className, $methodName];
                        }
                    }
                }
                exit();
            }
        }

        return null;
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