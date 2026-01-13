<?php

namespace Controllers\Admin;

class Home
{
    public function index(): void
    {
        view("admin/home.view.php");
    }
}
