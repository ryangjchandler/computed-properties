<?php

namespace RyanChandler\Computed;

use ReflectionObject;

/** @internal */
final class Support
{
    public static function methodHasAttribute(object $object, string $method, string $attribute): bool
    {
        $object = new ReflectionObject($object);
        $method = $object->getMethod($method);
        $attributes = $method->getAttributes($attribute);

        return count($attributes) > 0;
    }

    public static function getAttribute(object $object, string $method, string $attribute): mixed
    {
        $object = new ReflectionObject($object);
        $method = $object->getMethod($method);
        $attributes = $method->getAttributes($attribute);

        return $attributes[0];
    }
}
