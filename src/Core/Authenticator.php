<?php

namespace Core;

class Authenticator
{
    public function attempt(string $email, string $password): bool
    {
        $user = App::resolve('db')->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email,
        ])->find();

        if ($user && password_verify($password, $user['password'])) {
            $this->login([
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['type'],
            ]);

            return true;
        }

        return false;
    }

    public function login(array $user): void
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
        ];

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        Session::destroy();
    }
}
