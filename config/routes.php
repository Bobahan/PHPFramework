<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;

const MIDDLEWARES = [
    'auth' => PHPFramework\Middleware\Auth::class,
    'guest' =>  PHPFramework\Middleware\Guest::class
];

router()->add('/', [HomeController::class, 'index'], ['get']);
router()->add('/dashboard', [HomeController::class, 'dashboard'], ['get'])->middleware(['auth']);
router()->get('/register', [UserController::class, 'register'])->middleware(['guest']);
router()->post('/register', [UserController::class, 'store'])->middleware(['guest']);
router()->add('/login', [UserController::class, 'login'], ['get', 'post'])->middleware(['guest']);
router()->add('/contacts', [HomeController::class, 'index'], 'post');