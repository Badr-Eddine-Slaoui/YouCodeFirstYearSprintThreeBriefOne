<?php

namespace Foundations\DI;

use Exception;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;

class Container
{
    private array $bindings = [];
    private array $instances = [];

    public function bind(string $abstract, $class = null): void
    {
        $this->bindings[$abstract] = $class ?? $abstract;
    }

    public function resolve(string | array $abstract)
    {
        if (is_string($abstract)) {
            $count = 1;
            $abstract = [$abstract];
        } else {
            $count = count($abstract);
        }

        $object = [];
        
        for ($i = 0; $i < $count; $i++) {
            if (array_key_exists($abstract[$i], $this->instances) && $this->instances[$abstract[$i]] !== null) {
                return $this->instances[$abstract[$i]];
            }

            $this->bind($abstract[$i]);

            $object[$i] = is_callable($abstract[$i]) ? $abstract[$i]($this) : $this->build($abstract[$i]);

            $this->instances[$abstract[$i]] = $object[$i];
        }

        return count($abstract) === 1 ? $object[0] : $object;
    }

    private function build(string $class)
    {
        $reflector = new ReflectionClass($class);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Cannot instantiate {$class}");
        }

        $constructor = $reflector->getConstructor();

        if ($constructor === null) {
            return $reflector->newInstance();
        }

        $params = $constructor->getParameters();
        $dependencies = [];

        foreach ($params as $param) {
            $type = $param->getType();

            if ($type->isBuiltin()) {
                if ($param->isDefaultValueAvailable()) {
                    $dependencies[] = $param->getDefaultValue();
                    continue;
                }
                throw new Exception("Unresolvable dependency {$param->getName()} in {$class}");
            }

            $depClass = $type->getName();
            $dependencies[] = $this->resolve($depClass);
        }

        return $reflector->newInstanceArgs($dependencies);
    }

    public function call($callable, array $explicit = [])
    {
        if (is_array($callable)) {

            $object_or_Class = $callable[0];
            $method = $callable[1];

            $object = is_string($object_or_Class) ? $this->resolve($object_or_Class) : $object_or_Class;

            $ref = new ReflectionMethod($object, $method);
        } else {
            $ref = new ReflectionFunction($callable);
            $object = null;
        }

        $params = $ref->getParameters();
        $args = [];

        foreach ($params as $param) {
            $name = $param->getName();

            if (array_key_exists($name, $explicit)) {
                if(is_callable($explicit[$name])) {
                    $args[] = $explicit[$name]();
                    continue;
                }
                $args[] = $explicit[$name];
                continue;
            }

            $type = $param->getType();
            if ($type && !$type->isBuiltin()) {

                $args[] = $this->resolve($type->getName());

            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } else {
                throw new Exception("Unresolvable parameter \${$name} in callable");
            }
        }

        return $ref->invokeArgs($object, $args);
    }

    public function get(string $abstract){
        return $this->instances[$abstract] ?? null;
    }
}
