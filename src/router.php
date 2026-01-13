<?php

$router->get("/", "Controllers\Home");

$router->get("/admin", "Controllers\Admin\Home");
$router->get("/admin/funcionarios", "Controllers\Admin\Funcionario");
$router->get("/admin/funcionarios/cadastrar", "Controllers\Admin\Funcionario", "cadastrar");
