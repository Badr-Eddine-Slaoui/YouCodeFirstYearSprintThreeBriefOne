<?php
class Container
{
    protected array $bindings = [];
    protected array $instences = [];
    public function bind(string $abstract, $class = null): void
    {
        $this->bindings[$abstract] = $class ?? $abstract;
    }
    public function singleton(string $abstract, $class = null): void
    {
        $this->bindings[$abstract] = $class ?? $abstract;
        $this->instences[$abstract] = null;
    }

    public function resolve(string $abstract)
    {
        if (array_key_exists($abstract, $this->instences) && $this->instences[$abstract] !== null) {
            return $this->instences[$abstract];
        }

        $class = $this->bindings[$abstract] ?? $abstract;

        $object = is_callable($class) ? $class($this) : $this->build($class);

        if (array_key_exists($abstract, $this->instences)) {
            $this->instences[$abstract] = $object;
        }

        return $object;
    }

    protected function build(string $class)
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

            if (!$type) {
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
    public function call(callable $callable, array $explicit = [])
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
}
