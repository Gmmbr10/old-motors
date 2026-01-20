<?php

namespace Http\Controllers\Admin;

use Core\Enum\PositionTypes;
use Core\Session;

class Veiculo
{
    public function index(): void
    {
        view("admin/veiculos/index.view.php");
    }

    public function cadastrar(): void
    {
        view("admin/veiculos/cadastrar.view.php", [
            'errors' => Session::get('errors'),
            'types' => PositionTypes::cases(),
            'success' => Session::get('success') ?? null,
        ]);
    }

    public function store(): void
    {
        dd($_POST);
    }
}
