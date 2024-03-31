<?php

namespace App\Core\Router;

class Route
{
    private function __construct(
        private string $method,
        private string $uri,
        private $action
    ) {
    }

    public static function get(string $uri, $action): static
    {
        return new static('GET', $uri, $action);
    }

    public static function post(string $uri, $action): static
    {
        return new static('POST', $uri, $action);

    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getMethod()
    {
        return $this->method;
    }
}
