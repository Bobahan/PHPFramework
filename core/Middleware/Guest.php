<?php

namespace PHPFramework\Middleware;

class Guest
{
    public function handle()
    {
        // если пользователь авторизован
        if(check_auth()) {
            response()->redirect('/dashboard');
        }
    }
}
