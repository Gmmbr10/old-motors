<?php

declare(strict_types=1);

use Core\Router;

const BASE_PATH = __DIR__ . '/../';

spl_autoload_register(function ($class) {
    $result = str_replace('\\', '/', $class);

    require BASE_PATH . $result . '.php';
});

require BASE_PATH . 'Core/functions.php';

$router = new Router();

require BASE_PATH . 'router.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
