<?php

namespace Http\Controllers;

use Core\App;

class Carros
{
    public function index(): void
    {
        $db = App::resolve('db');

        $vehicles = $db->query('SELECT v.id as veh_id, v.mark, v.model, v.year, v.price, i.id as ima_id, i.path FROM vehicles v LEFT JOIN vehicle_images i ON v.id = i.vehicle_id WHERE v.status = \'completed\' AND i.main = 1')->get();

        view("carros.view.php", [
            'vehicles' => $vehicles
        ]);
    }

    public function detalhes(): void
    {
        $db = App::resolve('db');

        $id = $_GET['escolha'];

        if (!is_numeric($id)) {
            redirect(base_link('carros'));
        }

        $vehicle = $db->query(
            'SELECT * FROM vehicles WHERE status = \'completed\' AND id = :id',
            [
                'id' => $id
            ]
        )->find();

        if (!$vehicle) {
            redirect(base_link('carros'));
        }

        $images = $db->query('SELECT * FROM vehicle_images WHERE vehicle_id = :vehicle', [
            'vehicle' => $vehicle['id']
        ])->get();

        view("escolha.view.php", [
            'vehicle' => $vehicle,
            'images' => $images
        ]);
    }
}
