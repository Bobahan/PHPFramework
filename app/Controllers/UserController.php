<?php

namespace App\Controllers;

use App\Models\User;
use PHPFramework\Auth;
use Symfony\Component\VarDumper\Command\ServerDumpCommand;

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

        $data = $model->loadData();

        if(request()->isAjax()) {
            if(!$model->validate()) {
                echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
                die;
            }

            $model->save();

            echo json_encode(['status' => 'success', 'data' => $data]);
            die;
        }

        if(!$model->validate()) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            session()->setFlash('success', 'Validation is success');
        }

        $id = $model->save();

        response()->redirect('/register');
    }

    public function auth()
    {
        $model = new User();

        $data = $model->loadData();

        if(!$model->validate($model->attributes, [
            'required' => ['email', 'password']
        ])) {
            echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
            die;
        }

        $isAuth = Auth::login(['email' => $data['email'], 'password' => $data['password']]);

        if($isAuth) {
            echo json_encode(['status' => 'success', 'data' => 'Success login']);
            response()->redirect(base_url('/dashboard'));
            die; 
        } else {
            echo json_encode(['status' => 'error', 'data' => 'Wrong Email or Password']);
            die; 
        }

    }

    public function login()
    {
        // $credentials = [
        //     'email' => 'quvog@mailinator.com',
        //     'password' => 'Pa$$w0rd!'
        // ];

        // dump($key);
        // dump($value);
        // dump($credentials);

        // $user = database()->findOne('users', $value, $key);

        // dd($user);

        return view('user/login', [
            'title' => 'Login Page',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        response()->redirect(base_url('/login'));
    }
}