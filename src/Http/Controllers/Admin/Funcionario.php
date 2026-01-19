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
        $db = App::resolve('db');

        $registerPerPage = 10;
        $numberOfRegisters = $db->query('SELECT COUNT(*) as count FROM users')->find();

        $pagesNumber = ceil($numberOfRegisters['count'] / $registerPerPage);
        $currentPage = $_GET['page'] ?? 1;

        if ($currentPage > $pagesNumber || $currentPage < 1) {
            redirect(base_link('admin/funcionarios'));
        }

        $start = ($currentPage - 1) * $registerPerPage;

        $employees = $db->query('SELECT id, fullname, type FROM users LIMIT :start, :quantity', [
            ':start' => [$start, \PDO::PARAM_INT],
            ':quantity' => [$registerPerPage, \PDO::PARAM_INT],
        ])->get();

        view('admin/funcionarios/index.view.php', [
            'employees' => $employees,
            'pagesNumber' => $pagesNumber,
            'currentPage' => $currentPage,
            'range' => $range = 2,
            'start' => max(1, $currentPage - $range),
            'end' => min($pagesNumber, $currentPage + $range),
        ]);
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

    public function editar(): void
    {
        $employee = (int) $_GET['employee'] ?? null;

        if (!isset($employee) || !is_int($employee) || $employee == Session::get('user')['id']) {
            redirect(base_link('admin/funcionarios'));
        }

        $db = App::resolve('db');

        $employee = $db->query('SELECT * FROM users WHERE id = :id LIMIT 1', [
            ':id' => $employee,
        ])->find();

        if (!$employee) {
            redirect(base_link('admin/funcionarios'));
        }

        view('admin/funcionarios/editar.view.php', [
            'employee' => $employee,
            'errors' => $errors ?? [],
            'types' => PositionTypes::cases(),
            'rollback' => Session::get('rollback') ?? $_SERVER['HTTP_REFERER'],
            'success' => Session::get('success') ?? null,
        ]);
    }

    public function patch(): void
    {
        $rollback = $_POST['rollback'];

        $form = FormsFuncionario::validate($attributes = [
            'id' => $_POST['id'],
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'position' => $_POST['position'],
            'cellnumber' => $_POST['cellnumber']
        ]);

        if ($attributes['id'] == Session::get('user')['id']) {
            redirect($rollback);
        }

        $db = App::resolve('db');
        $db->query('UPDATE users SET fullname = :fullname, email = :email, type = :position, cellnumber = :cellnumber WHERE id = :id;)', $attributes);

        Session::flash('success', 'Funcionário atualizado com sucesso!');
        Session::flash('rollback', $rollback);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(): void
    {
        $rollback = $_POST['rollback'];

        $attributes = [
            'id' => $_POST['id'],
        ];

        if ($attributes['id'] == Session::get('user')['id']) {
            redirect($rollback);
        }

        $db = App::resolve('db');
        $db->query('DELETE FROM users WHERE id = :id', $attributes);

        Session::flash('success', 'Funcionário deletado com sucesso!');
        Session::flash('rollback', $rollback);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function passwordReset(): void
    {
        $rollback = $_POST['rollback'];

        $attributes = [
            'id' => $_POST['id'],
            'password' => password_hash('oldMotors', PASSWORD_BCRYPT),
        ];

        if ($attributes['id'] == Session::get('user')['id']) {
            redirect($rollback);
        }

        $db = App::resolve('db');
        $db->query('UPDATE users SET password = :password WHERE id = :id;)', $attributes);

        Session::flash('success', 'Senha reiniciada com sucesso!');
        Session::flash('rollback', $rollback);

        redirect($_SERVER['HTTP_REFERER']);
    }
}
