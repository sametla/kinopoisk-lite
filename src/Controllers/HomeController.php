<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        include_once ROOT.'/views/pages/home.php';
    }
}
