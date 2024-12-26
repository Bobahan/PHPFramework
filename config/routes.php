<?php

use App\Controllers\HomeController;

router()->add('/home', [HomeController::class, 'index'], ['get', 'post']);
router()->add('/alex', [HomeController::class, 'home'], ['get']);
router()->add('/', [HomeController::class, 'index'], ['get']);
router()->add('/contacts', [HomeController::class, 'index'], 'post');

// router()->get('/home', [HomeController::class, 'index']);
// router()->post('/contact', [HomeController::class, 'contact']);

// dd(router()->getRoutes());