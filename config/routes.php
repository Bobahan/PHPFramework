<?php

use App\Controllers\Api\V1\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\UserController;

const MIDDLEWARES = [
    'auth' => PHPFramework\Middleware\Auth::class,
    'guest' =>  PHPFramework\Middleware\Guest::class
];

router()->add('/', [HomeController::class, 'index'], ['get']);
router()->get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth']);
router()->get('/logout', [UserController::class, 'logout'])->middleware(['auth']);
router()->get('/register', [UserController::class, 'register'])->middleware(['guest']);
router()->post('/register', [UserController::class, 'store']);
router()->get('/login', [UserController::class, 'login'])->middleware(['guest']);
router()->post('/login', [UserController::class, 'auth'])->middleware(['guest']);
router()->add('/contacts', [HomeController::class, 'index'], 'post');

// API
router()->get('/api/v1/categories', [CategoryController::class, 'index']);
router()->get('/api/v1/categories(?P<slug>[a-z0-9-]+)', [CategoryController::class, 'view']);