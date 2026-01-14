<?php

namespace Http\Controllers;

class Home
{
    public function index(): void
    {
        view("home.view.php");
    }
}
