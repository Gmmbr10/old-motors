<?php

namespace Controllers\Admin;

class Funcionario
{
    public function index(): void
    {
        view('admin/funcionarios/index.view.php');
    }

    public function cadastrar(): void
    {
        view('admin/funcionarios/cadastrar.view.php');
    }
}
