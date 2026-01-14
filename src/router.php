<?php

$router->get("/", "Http\Controllers\Home");

$router->get("/admin", "Http\Controllers\Admin\Auth");
$router->get("/admin/home", "Http\Controllers\Admin\Home");
$router->get("/admin/funcionarios", "Http\Controllers\Admin\Funcionario");
$router->get("/admin/funcionarios/cadastrar", "Http\Controllers\Admin\Funcionario", "cadastrar");
