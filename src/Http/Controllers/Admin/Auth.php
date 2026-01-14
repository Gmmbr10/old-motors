<?php

namespace Http\Controllers\Admin;

class Auth
{
    public function index(): void
    {
        view('admin/auth/login.view.php');
    }
}
