<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;

router()->add('/', [HomeController::class, 'index'], ['get']);
router()->get('/register', [UserController::class, 'register']);
router()->post('/register', [UserController::class, 'store']);
router()->add('/login', [UserController::class, 'login'], ['get', 'post']);
router()->add('/contacts', [HomeController::class, 'index'], 'post');