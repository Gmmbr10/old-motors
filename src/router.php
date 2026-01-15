<?php

$router->get("/", "Http\Controllers\Home");

$router->get("/admin", "Http\Controllers\Admin\Auth");
$router->post("/admin", "Http\Controllers\Admin\Auth", 'check');

$router->get("/logout", "Http\Controllers\Logout")->middleware('auth');

$router->get("/admin/home", "Http\Controllers\Admin\Home")->middleware('auth');

$router->get("/admin/funcionarios", "Http\Controllers\Admin\Funcionario")->middleware('admin');
$router->get("/admin/funcionarios/cadastrar", "Http\Controllers\Admin\Funcionario", "cadastrar")->middleware('admin');
$router->post("/admin/funcionarios/cadastrar", "Http\Controllers\Admin\Funcionario", "store")->middleware('admin');
