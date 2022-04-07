<?php

namespace Core;

class Router
{
	public array $routes = [

		'GET' => [],

		'POST' => []
	];

	public function get($uri, $controller)
	{
		$this->routes['GET'][$uri] = $controller;
	}

	public function post($uri, $controller)
	{
		$this->routes['POST'][$uri] = $controller;
	}

	public static function load($file): Router
	{
		$router = new static;

		require $file;

		return $router;
	}

	/**
	 * @throws \Exception
	 */
	public function direct($url, $requestType)
	{
		if(!array_key_exists($url, $this->routes[$requestType]))
		{
			Throw new \Exception('Route not defined for this URI');
		}

		$args = explode('@', $this->routes[$requestType][$url]);

		return $this->callAction(...$args);
	}

	public function callAction($controller, $action)
	{
		$controller = new $controller;

		if (!method_exists($controller, $action)) {
			Throw new \Exception(
				"{$controller} does not respond to the {$action} action."
			);
		}

		return $controller->$action();
	}
}

