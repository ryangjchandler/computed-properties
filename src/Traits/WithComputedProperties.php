<?php

namespace RyanChandler\Computed\Traits;

use ReflectionMethod;
use ReflectionObject;
use RyanChandler\Computed\Attributes\Computed;

trait WithComputedProperties
{
    protected function getComputedHandler(string $name): ?string
    {
        $method = 'get' . ucwords($name) . 'Property';

        if (method_exists(static::class, $method)) {
            return $method;
        }

        $object = new ReflectionObject($this);

        $methods = array_filter(
            $object->getMethods(
                ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED | ReflectionMethod::IS_PRIVATE
            ), function (ReflectionMethod $method) {
                return count($method->getAttributes(Computed::class)) > 0;
            }
        );

        foreach ($methods as $method) {
            $attribute    = $method->getAttributes(Computed::class)[0];
            $computedName = $attribute->newInstance()->name ?? $method->getName();

            if ($computedName === $name) {
                return $method->getName();
            }
        }

        return null;
    }

    public function __get(string $name)
    {
        if ($method = $this->getComputedHandler($name)) {
            return $this->{$method}();
        }
    }
}
