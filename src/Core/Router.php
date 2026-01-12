<?php

namespace Core;

class Router
{
    private array $routes = [];

    public function add(string $method, string $uri, string $controller, string $function = 'index'): self
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'function' => $function,
            'middleware' => null,
        ];

        return $this;
    }

    public function middleware(mixed $value): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $value;

        return $this;
    }

    public function get(string $uri, string $controller): self
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): self
    {
        return $this->add('POST', $uri, $controller);
    }

    public function patch(string $uri, string $controller): self
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function delete(string $uri, string $controller): self
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {

            if ($route['method'] == $method && $route['uri'] == $uri) {

                $controller = $route['controller'];

                $function = $route['function'];

                (new $controller())->$function();
            }
        }
    }
}
