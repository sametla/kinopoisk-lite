<?php

namespace App\Controllers;

class MovieController
{
    public function index()
    {
        include_once ROOT.'/views/pages/movies.php';
    }
}
