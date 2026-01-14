<?php

use Core\App;
use Core\Database;
use Core\Dependences;

$container = new Dependences();

$container->bind('db', function () {
    $config = require base_path('config.php');

    return new Database($config['database']);
});

App::setContainer($container);
