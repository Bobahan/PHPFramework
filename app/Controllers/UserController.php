<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function register()
    {
        return view('user/register', [
            'title' => 'Register Page'
        ]);
    }

    public function store()
    {
        $model = new User();

        $model->loadData();

        if($model->validate()) {

        }

        dump($model->getErrors());
    }

    public function login()
    {
        return view('user/login', [
            'title' => 'Login Page'
        ]);
    }
}