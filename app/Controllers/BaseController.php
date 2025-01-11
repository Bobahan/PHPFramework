<?php

namespace App\Controllers;

use PHPFramework\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        // если menu нет в cache мы кладем его в туда
        if(!cache()->get('menu')) {
            cache()->set('menu', $this->renderMenu(), 1);
        }
    }

    public function renderMenu()
    {
        return view()->renderPartial('menu');
    }
}