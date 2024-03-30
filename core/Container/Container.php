<?php

namespace App\Core\Container;

use App\Core\Http\Redirect;
use App\Core\Http\Request;
use App\Core\Router\Router;
use App\Core\Validator\Validator;
use App\Core\View\View;

class Container
{
    public readonly Request $request;

    public readonly Router $router;

    public readonly View $view;

    public readonly Validator $validator;

    public readonly Redirect $redirect;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->view = new View;
        $this->redirect = new Redirect();
        $this->validator = new Validator();
        $this->request->setValidator($this->validator);
		$this->router = new Router($this->view, $this->request, $this->redirect);
    }
}
