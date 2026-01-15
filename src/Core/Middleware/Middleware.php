<?php

namespace Core\Middleware;

class Middleware
{

    public const MAP = [
        'auth' => Authenticated::class,
        'admin' => Admin::class,
    ];

    public static function resolve(?string $key): void
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new \Exception("Middleware inexistente!");
        }

        (new $middleware)->handle();
    }
}
