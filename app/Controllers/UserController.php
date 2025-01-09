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

        if(!$model->validate()) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            session()->setFlash('success', 'Validation is success');
        }

        response()->redirect('/register');
    }

    public function login()
    {
        return view('user/login', [
            'title' => 'Login Page'
        ]);
    }
}