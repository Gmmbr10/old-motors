<?php

namespace Http\Controllers\Admin;

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginAdmin;

class Auth
{
    public function index(): void
    {
        view('admin/auth/login.view.php', [
            'errors' => Session::get('errors'),
        ]);
    }

    public function check(): void
    {

        $form = LoginAdmin::validate(
            $attributes = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ]
        );

        $signedIn = (new Authenticator)->attempt(
            email: $attributes['email'],
            password: $attributes['password']
        );

        if (!$signedIn) {
            $form->error(
                'email',
                'Nenhuma conta foi encontrada com este email e senha'
            )->throw();
        }

        redirect(base_link('admin/home'));
    }
}
