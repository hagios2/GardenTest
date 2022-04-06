<?php

//use App\GardenCalculator;
require 'app/GardenCalculator.php';

class Router
{
	protected $routes = [
		'GET' => [],

		'POST' => []
	];

	public function get($uri, $controller, $method)
	{
		$this->routes['GET'][$uri] = (new $controller())->$method();
	}

	public function post($uri, $controller)
	{
		$this->routes['POST'][$uri] = $controller;
	}

	public static function load($file)
	{
		$router = new static;

		require $file;

		return $router;
	}

	/**
	 * @throws Exception
	 */
	public function direct($url, $requestType)
	{
		if(array_key_exists($url, $this->routes[$requestType]))
		{
			return $this->routes[$requestType][$url];
		}

		Throw new Exception('Route not defined for this URI');
	}
}

