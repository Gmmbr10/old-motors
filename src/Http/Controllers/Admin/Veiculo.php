<?php

namespace Http\Controllers\Admin;

use Core\App;
use Core\Router;
use Core\Session;
use Http\Forms\FormsVeiculo;
use Http\Forms\FormsVeiculoImage;

class Veiculo
{
    public function index(): void
    {
        $db = App::resolve('db');

        $vehicles = $db->query('SELECT id, mark, model, year, plate, price FROM vehicles')->get();

        view("admin/veiculos/index.view.php", [
            'vehicles' => $vehicles,
        ]);
    }

    public function cadastrar(): void
    {
        view("admin/veiculos/cadastrar.view.php", [
            'errors' => Session::get('errors'),
        ]);
    }

    public function store(): void
    {
        $form = FormsVeiculo::validate($attributes = [
            'mark' => $_POST['mark'],
            'model' => $_POST['model'],
            'year' => (int) $_POST['year'],
            'carPlate' => $_POST['carPlate'],
            'price' => (float) $_POST['price'],
        ]);

        $db = App::resolve('db');
        $db->query('INSERT INTO vehicles (mark,model,year,plate,price) VALUES (:mark,:model,:year,:carPlate,:price)', $attributes);

        $id = $db->lastInsertId();

        if (!is_numeric($id)) {
            $form->error('unknown', 'Erro ao cadastrar o veículo');
        }

        Session::flash('vehicleId', $id);

        redirect(base_link('admin/veiculos/cadastrar/imagens?id=' . $id));
    }

    public function cadastrarImagens(): void
    {
        view("admin/veiculos/imagens/cadastrar.view.php", [
            'id' => Session::get('vehicleId') ?? $_GET['id'] ?? null,
            'errors' => Session::get('errors'),
            'success' => Session::get('success') ?? null,
        ]);
    }

    public function storeImages(): void
    {
        $db = App::resolve('db');
        $form = new FormsVeiculoImage([]);
        $id = (int) $_POST['vehicleId'];

        if (!is_numeric($id)) {
            redirect(base_link('admin/veiculos'));
        }

        $vehicle = $db->query('SELECT * FROM vehicles WHERE id = :id', ['id' => $id])->find();

        if (!isset($vehicle)) {
            redirect(base_link('admin/veiculos'));
        }

        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
        $tamanhoMaximo = 10 * 1024 * 1024;

        foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
            if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) {
                $form->error('error', 'Erro no upload');
                $form->throw();
            }

            if ($_FILES['images']['size'][$i] > $tamanhoMaximo) {
                $form->error('error', 'Imagem muito grande');
                $form->throw();
            }

            if (!in_array($_FILES['images']['type'][$i], $tiposPermitidos)) {
                $form->error('error', 'Tipo inválido');
                $form->throw();
            }

            $info = getimagesize($tmp);
            if ($info === false) {
                $form->error('error', 'Arquivo não é imagem');
                $form->throw();
            }
        }

        $hasImage = false;
        $totalSuccess = 0;

        foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
            $extensao = str_replace("image/", "", $_FILES["images"]["type"][$i]);
            $nomeImagem = sha1(uniqid(time())) . "." . $extensao;
            $caminho_db = "storage/vehicles/" . $nomeImagem;
            $caminho = base_path($caminho_db);

            if (move_uploaded_file($tmp, $caminho)) {
                $totalSuccess++;

                if (!$hasImage) {
                    $hasImage = true;
                    $db->query('UPDATE vehicles SET status="completed" WHERE id = :id', ['id' => $id]);
                }

                $db->query('INSERT INTO vehicle_images (path, vehicle_id, main) VALUES (:path,:id,:main)', [
                    'id' => $id,
                    'path' => $caminho_db,
                    'main' => $totalSuccess == 1 ? '1' : '0',
                ]);
            }
        }

        Session::flash('success', 'Veículo registrado com sucesso!');

        redirect(base_link('admin/veiculos/cadastrar'));
    }

    public function editar(): void
    {
        $id = (int) $_GET['id'];

        if (!isset($id) || !is_numeric($id)) {
            redirect($_SERVER['HTTP_REFERER'] ?? base_link('admin/veiculos'));
        }

        $db = App::resolve('db');
        $vehicle = $db->query('SELECT * FROM vehicles WHERE id = :id', ['id' => $id])->find();
        $images = $db->query('SELECT * FROM vehicle_images WHERE vehicle_id = :id', ['id' => $id])->get();

        if (!$vehicle) {
            redirect($_SERVER['HTTP_REFERER'] ?? base_link('admin/veiculos'));
        }

        view("admin/veiculos/editar.view.php", [
            'errors' => Session::get('errors'),
            'vehicle' => $vehicle,
            'images' => $images,
            'success' => Session::get('success') ?? null,
            'rollback' => Session::get('rollback') ?? $_SERVER['HTTP_REFERER'] ?? base_link('admin/veiculos'),
        ]);
    }

    public function patch(): void
    {
        $form = FormsVeiculo::validate($attributes = [
            'id' => $_POST['id'] ?? $_GET['id'],
            'mark' => $_POST['mark'],
            'model' => $_POST['model'],
            'year' => (int) $_POST['year'],
            'carPlate' => $_POST['carPlate'],
            'price' => (float) $_POST['price'],
        ]);

        $db = App::resolve('db');
        $vehicle = $db->query('SELECT * FROM vehicles WHERE id = :id', ['id' => $attributes['id']])->find();

        if (!isset($vehicle)) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $db->query('UPDATE vehicles SET mark=:mark, model=:model, year=:year, plate=:carPlate, price=:price WHERE id=:id', $attributes);

        Session::flash('rollback', $_POST['rollback']);
        Session::flash('success', 'Dados atualizados com sucesso!');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function patchImage(): void {}
}
