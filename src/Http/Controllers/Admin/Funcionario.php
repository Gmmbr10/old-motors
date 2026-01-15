<?php

namespace Http\Controllers\Admin;

use Core\App;
use Core\Enum\PositionTypes;
use Core\Session;
use Http\Forms\FormsFuncionario;

class Funcionario
{
    public function index(): void
    {
        view('admin/funcionarios/index.view.php');
    }

    public function cadastrar(): void
    {
        view('admin/funcionarios/cadastrar.view.php', [
            'errors' => Session::get('errors'),
            'types' => PositionTypes::cases(),
        ]);
    }

    public function store(): void
    {
        $form = FormsFuncionario::validate($attributes = [
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'position' => $_POST['position'],
            'cellnumber' => $_POST['cellnumber'],
            'password' => password_hash('oldMotors', PASSWORD_BCRYPT),
        ]);

        $db = App::resolve('db');
        $db->query('INSERT INTO users (fullname, email, type, cellnumber, password) VALUES (:fullname, :email, :position, :cellnumber, :password)', $attributes);

        redirect(base_link('admin/funcionarios/cadastrar'));
    }
}
