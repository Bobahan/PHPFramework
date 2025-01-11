<?php

namespace App\Controllers\Api\V1;

class CategoryController
{

    // возвращаем список категорий
    public function index()
    {
        $categories = database()->findAll('categories');

        response()->json(['status' => 'ok', 'data' => $categories]);
    }

    // возвращаем 1 конкретную категорию
    public function view()
    {
        echo 'hello from view api';
    }
}