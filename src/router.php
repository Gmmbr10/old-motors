<?php

$router->get("/", "Http\Controllers\Home");

$router->get("/carros", "Http\Controllers\Carros");
$router->get("/carros/detalhes", "Http\Controllers\Carros", 'detalhes');

$router->get("/admin", "Http\Controllers\Admin\Auth");
$router->post("/admin", "Http\Controllers\Admin\Auth", 'check');

$router->get("/logout", "Http\Controllers\Logout")->middleware('auth');

$router->get("/admin/home", "Http\Controllers\Admin\Home")->middleware('auth');

$router->get("/admin/funcionarios", "Http\Controllers\Admin\Funcionario")->middleware('admin');
$router->get("/admin/funcionarios/cadastrar", "Http\Controllers\Admin\Funcionario", "cadastrar")->middleware('admin');
$router->post("/admin/funcionarios/cadastrar", "Http\Controllers\Admin\Funcionario", "store")->middleware('admin');
$router->get("/admin/funcionarios/editar", "Http\Controllers\Admin\Funcionario", "editar")->middleware('admin');
$router->patch("/admin/funcionarios/editar", "Http\Controllers\Admin\Funcionario", "patch")->middleware('admin');
$router->patch("/admin/funcionarios/editar/senha", "Http\Controllers\Admin\Funcionario", "passwordReset")->middleware('admin');
$router->delete("/admin/funcionarios/deletar", "Http\Controllers\Admin\Funcionario", "delete")->middleware('admin');

$router->get('/admin/veiculos', 'Http\Controllers\Admin\Veiculo')->middleware('admin');
$router->get('/admin/veiculos/cadastrar', 'Http\Controllers\Admin\Veiculo', 'cadastrar')->middleware('admin');
$router->post('/admin/veiculos/cadastrar', 'Http\Controllers\Admin\Veiculo', 'store')->middleware('admin');
$router->get('/admin/veiculos/editar', 'Http\Controllers\Admin\Veiculo', 'editar')->middleware('admin');
$router->patch('/admin/veiculos/editar', 'Http\Controllers\Admin\Veiculo', 'patch')->middleware('admin');
$router->delete('/admin/veiculos', 'Http\Controllers\Admin\Veiculo', 'delete')->middleware('admin');

$router->get('/admin/veiculos/cadastrar/imagens', 'Http\Controllers\Admin\Veiculo', 'cadastrarImagens')->middleware('admin');
$router->post('/admin/veiculos/cadastrar/imagens', 'Http\Controllers\Admin\Veiculo', 'storeImages')->middleware('admin');
$router->patch('/admin/veiculos/imagens/principal', 'Http\Controllers\Admin\Veiculo', 'patchImage')->middleware('admin');
$router->delete('/admin/veiculos/imagens', 'Http\Controllers\Admin\Veiculo', 'deleteImage')->middleware('admin');
