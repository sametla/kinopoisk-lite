<?php

namespace App\Core;

use App\Core\Container\Container;

class App
{
    private Container $container;

    public function __construct()
    {
        $container = new Container();
    }

    public function run(): void
    {
        $this->container->router->dispatch(
            $this->container->request->uri(),
            $this->container->request->method()
        );
    }
}
