<?php

function dd(...$value)
{
    echo '<pre>';

    var_dump(...$value);

    echo '</pre>';

    die();
}

function base_link(string $link): string
{
    return str_contains($_SERVER['REQUEST_URI'], 'old-motors') ? '/old-motors/' . $link : '/' . $link;
}

function base_path(string $path): string
{
    return BASE_PATH . $path;
}

function view(string $view, array $data = []): void
{
    extract($data);
    require base_path('Views/' . $view);
}

function redirect(string $path): void
{
    header("location: {$path}");
    exit();
}

function old(string $key, mixed $default = ''): mixed
{
    return \Core\Session::get('old')[$key] ?? $default;
}
