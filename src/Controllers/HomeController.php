<?php

namespace App\Controllers;

use App\View;

class HomeController
{

    public function index() : string
    {
        return View::make('index');
    }
}