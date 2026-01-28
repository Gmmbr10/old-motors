<?php

namespace Http\Controllers;

use Core\App;

class Carros
{
    public function index(): void
    {
        $db = App::resolve('db');

        $vehicles = $db->query('SELECT v.id as veh_id, v.mark, v.model, v.year, v.price, i.id as ima_id, i.path FROM vehicles v LEFT JOIN vehicle_images i ON v.id = i.vehicle_id WHERE v.status = \'completed\' AND i.main = 1')->get();

        // dd($vehicles);

        view("carros.view.php", [
            'vehicles' => $vehicles
        ]);
    }
}
