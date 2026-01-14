<?php

namespace Core;

class App
{
    private static Dependences $container;

    public static function setContainer(Dependences $container): void
    {
        static::$container = $container;
    }

    private static function container(): Dependences
    {
        return static::$container;
    }

    public static function resolve(string $key): mixed
    {
        return static::container()->resolve($key);
    }
}
