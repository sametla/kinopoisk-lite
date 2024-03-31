<?php

namespace App\Core\Router;

use App\Core\Controller\Controller;
use App\Core\Database\DatabaseInterface;
use App\Core\Http\RedirectInterface;
use App\Core\Http\RequestInterface;
use App\Core\Session\SessionInterface;
use App\Core\View\ViewInterface;
use JetBrains\PhpStorm\NoReturn;

class Router implements RouterInterface
{
    #[NoReturn]
    public function __construct(
        private readonly ViewInterface $view,
        private readonly RequestInterface $request,
        private readonly RedirectInterface $redirect,
        private readonly SessionInterface $session,
        private readonly DatabaseInterface $db,
    ) {
        $this->initRoutes();
    }

    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    #[NoReturn]
    public function initRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (! $route) {
            $this->notFound();
        }

        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();

            /** @var Controller $controller */
            $controller = new $controller();

            $controller->setView($this->view);
            $controller->setRequest($this->request);
            $controller->setRedirect($this->redirect);
            $controller->setSession($this->session);
            $controller->setDatabase($this->db);
            $controller->$action();
        } else {
            call_user_func($route->getAction());
        }
    }

    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require ROOT.'/config/routes.php';
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    #[NoReturn]
    private function notFound(): void
    {
        echo '404 | Not Found';
        exit();
    }
}
