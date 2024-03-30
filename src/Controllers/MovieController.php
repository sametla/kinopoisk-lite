<?php

namespace App\Controllers;

use App\Core\Controller\Controller;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
        ]);

        if (! $validation) {
            $this->redirect('/admin/movies/add');
            // dd('Validation failed', $this->request()->errors());
        }

        dd('Validation passed');
    }
}
