<?php

namespace Core;

class ServiceContainer
{
	protected static array $container = [];

	public static function bind($key, $value)
	{
		static::$container[$key] = $value;
	}

	public static function get($key)
	{
		if (!array_key_exists($key, static::$container)) {
			throw new \Exception('No Key $exists');
		}

		return static::$container[$key];
	}
}
