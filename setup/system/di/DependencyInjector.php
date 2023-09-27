<?php

namespace setup\system\di;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;

class DependencyInjector implements ContainerInterface
{
    protected array $bindings = [];

    public function bind(string $abstract, $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    /**
     * @throws ReflectionException
     */
    public function get(string $id)
    {
        if (isset($this->bindings[$id])) {
            $concrete = $this->bindings[$id];
            if (is_callable($concrete)) {
                return $concrete($this);
            }
            return $this->resolve($concrete);
        }

        return $this->resolve($id);
    }

    /**
     * @throws ReflectionException
     */
    protected function resolve($concrete)
    {
        $reflectionClass = new ReflectionClass($concrete);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor === null) {
            return new $concrete();
        }

        $dependencies = $this->resolveDependencies($constructor->getParameters());

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    /**
     * @throws ReflectionException
     */
    protected function resolveDependencies(array $dependencies): array
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
        return 0;
    }
}