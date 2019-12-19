<?php

namespace JavaLikeEnum\Enum;

use BadMethodCallException;
use LogicException;
use ReflectionClass;

trait Enum
{
    private static $instances = [];

    private $scalar;

    final private function __construct($value)
    {
        $this->scalar = $value;
    }

    // phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
    final public static function __callStatic($label, $args)
    {
        // phpcs:enable
        $class = get_called_class();
        if (! defined('static::' . $label)) {
            throw new BadMethodCallException('Undefined enum by ' . $label);
        }

        $static_name = $class . '::' . $label;
        $const = constant($static_name);

        if (! isset(static::$instances[$static_name])) {
            static::$instances[$static_name] = new $class($const);
        }

        return static::$instances[$static_name];
    }

    final public function __clone()
    {
        throw new LogicException;
    }

    public function __toString()
    {
        return (string) $this->scalar;
    }

    final public static function values()
    {
        $class = get_called_class();
        $ref = new ReflectionClass($class);
        $consts = $ref->getConstants();

        return array_map(function ($const_name) {
            return static::$const_name();
        }, array_keys($consts));
    }

    public function valueOf()
    {
        return $this->scalar;
    }
}
