<?php

namespace App\Core\Container;

use App\Core\Config\Config;
use App\Core\Config\ConfigInterface;
use App\Core\Database\Database;
use App\Core\Database\DatabaseInterface;
use App\Core\Http\Redirect;
use App\Core\Http\RedirectInterface;
use App\Core\Http\Request;
use App\Core\Http\RequestInterface;
use App\Core\Router\Router;
use App\Core\Router\RouterInterface;
use App\Core\Session\Session;
use App\Core\Session\SessionInterface;
use App\Core\Validator\Validator;
use App\Core\Validator\ValidatorInterface;
use App\Core\View\View;
use App\Core\View\ViewInterface;

class Container
{
    public readonly RequestInterface $request;

    public readonly RouterInterface $router;

    public readonly ViewInterface $view;

    public readonly ValidatorInterface $validator;

    public readonly RedirectInterface $redirect;

    public readonly SessionInterface $session;

    public readonly ConfigInterface $config;

    public readonly DatabaseInterface $db;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->session = new Session();
        $this->view = new View($this->session);
        $this->redirect = new Redirect();
        $this->validator = new Validator();
        $this->request->setValidator($this->validator);
        $this->config = new Config();
        $this->db = new Database($this->config);

        $this->router = new Router($this->view, $this->request, $this->redirect, $this->session, $this->db);
    }
}
