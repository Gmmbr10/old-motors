<?php

namespace Core;

use Exception;

class Dependences
{
    private array $bindings = [];

    public function bind(string $key, callable $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception('Dependencia não encontrada!');
        }

        $resolver = $this->bindings[$key];

        return $resolver();
    }
}
