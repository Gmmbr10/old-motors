<?php

namespace Core\Middleware;

class Admin
{

    public function handle(): void
    {
        (new Authenticated)->handle();

        if (strtolower($_SESSION['user']['role']) != 'admin' ?? false) {
            header('location: ' . base_link('/'));
            exit();
        }
    }
}
