<?php

namespace Core;

use Core\Middleware\Middleware;

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

    public function get(string $uri, string $controller, string $function = 'index'): self
    {
        return $this->add('GET', $uri, $controller, $function);
    }

    public function post(string $uri, string $controller, string $function = 'index'): self
    {
        return $this->add('POST', $uri, $controller, $function);
    }

    public function patch(string $uri, string $controller, string $function = 'index'): self
    {
        return $this->add('PATCH', $uri, $controller, $function);
    }

    public function delete(string $uri, string $controller, string $function = 'index'): self
    {
        return $this->add('DELETE', $uri, $controller, $function);
    }

    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {

            if ($route['method'] == $method && $route['uri'] == $uri) {

                Middleware::resolve($route['middleware']);

                $controller = $route['controller'];

                $function = $route['function'];

                (new $controller())->$function();
            }
        }
    }
}
