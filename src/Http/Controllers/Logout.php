<?php

namespace Http\Controllers;

use Core\Authenticator;

class Logout
{
    public function index(): void
    {
        (new Authenticator)->logout();

        redirect(base_link(''));
    }
}
