<?php

declare(strict_types=1);

use Core\Router;
use Core\Session;
use Core\ValidatorException;

const BASE_PATH = __DIR__ . '/../';

spl_autoload_register(function ($class) {
    $result = str_replace('\\', '/', $class);

    require BASE_PATH . $result . '.php';
});

require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'bootstrap.php';

session_start();

$router = new Router();
require BASE_PATH . 'router.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];


try {
    $router->route($uri, $method);
} catch (ValidatorException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousURL());
}
