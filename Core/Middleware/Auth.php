<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        // dd($_SESSION['user']);
        if (!$_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}
