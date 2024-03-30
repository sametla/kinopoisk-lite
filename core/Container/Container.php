<?php

namespace App\Core\Container;

use App\Core\Http\Request;
use App\Core\Router\Route;
use App\Core\Router\Router;

class Container
{
	public readonly Request $request;

	public readonly Router $router;

	public function __construct()
	{
		$this->registerServices();
	}

	private function registerServices()
	{
		$this->request = Request::createFromGlobals();
		$this->router = new Router();
	}
}
