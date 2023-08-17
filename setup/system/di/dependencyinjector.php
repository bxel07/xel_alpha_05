<?php

namespace setup\system\di;

use Psr\Container\ContainerInterface;

class dependencyinjector implements ContainerInterface
{
    protected $bindings = [];

    public function bind(string $abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function get($abstract)
    {
        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];
            if (is_callable($concrete)) {
                return $concrete($this);
            }
            return $this->resolve($concrete);
        }

        return $this->resolve($abstract);
    }

    /**
     * @throws \ReflectionException
     */
    protected function resolve($concrete)
    {
        $reflectionClass = new \ReflectionClass($concrete);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor === null) {
            return new $concrete();
        }

        $dependencies = $this->resolveDependencies($constructor->getParameters());

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    protected function resolveDependencies(array $dependencies)
    {
        $resolvedDependencies = [];
        foreach ($dependencies as $parameter) {
            $resolvedDependencies[] = $this->get($parameter->getType()->getName());
        }
        return $resolvedDependencies;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }
}