<?php

namespace App\Core\Router;

use App\Core\Controller\Controller;
use App\Core\Http\Redirect;
use App\Core\Http\Request;
use App\Core\View\View;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    #[NoReturn]
    public function __construct(
        private readonly View $view,
        private readonly Request $request,
        private readonly Redirect $redirect
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
