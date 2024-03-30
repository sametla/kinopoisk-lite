<?php

namespace App\Core\Controller;

use App\Core\Http\Redirect;
use App\Core\Http\Request;
use App\Core\View\View;

abstract class Controller
{
    private View $view;

    private Redirect $redirect;

    private Request $request;

    public function view(string $name): void
    {
        $this->view->page($name);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }
}
