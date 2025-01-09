<?php

namespace PHPFramework\Middleware;

class Auth
{
    public function handle()
    {
        // если пользователь не авторизован
        if(!check_auth()) {
            session()->setFlash('error', 'Нужно авторизоваться');
            response()->redirect('/login');
        }
    }
}
