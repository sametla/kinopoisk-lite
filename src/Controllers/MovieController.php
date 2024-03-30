<?php

namespace App\Controllers;

use App\Core\Controller\Controller;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }
}
