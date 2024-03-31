<?php

namespace App\Core\Controller;

use App\Core\Http\RedirectInterface;
use App\Core\Http\RequestInterface;
use App\Core\Session\SessionInterface;
use App\Core\View\View;
use App\Core\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;

    private RedirectInterface $redirect;

    private RequestInterface $request;

    private SessionInterface $session;

    public function view(string $name): void
    {
        $this->view->page($name);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }
}
