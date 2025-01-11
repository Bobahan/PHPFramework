<?php

namespace PHPFramework;

class Auth
{
    public static function login(array $credentials): bool
    {
        $password = $credentials['password'];
        unset($credentials['password']);

        $key = array_key_first($credentials);
        $value = $credentials[$key];

        $user = database()->findOne('users', $value, $key);

        if(!$user) {
            return false;
        }

        if($password === $user['password']) {
            session()->set('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ]);

            return true;
        }

        return false;
    }

    public static function user()
    {
        return session()->get('user');
    }

    public static function isAuth()
    {
        return session()->has('user');
    }

    public static function logout()
    {
        return session()->remove('user');
    }

    public static function setUser()
    {
        if($user_data = self::user()) {
            $user = database()->findOne('users', $user_data['id']);

            if($user) {
                session()->set('user', [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ]);
            }
        }
    }
}