<?php

namespace App\Core\Container;

use App\Core\Http\Request;
use App\Core\Router\Router;
use App\Core\View\View;

class Container
{
    public readonly Request $request;

    public readonly Router $router;

    public readonly View $view;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->router = new Router($this->view = new View(), $this->request);
    }
}
