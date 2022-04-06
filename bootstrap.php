<?php

use Core\Database\Connection;
use Core\Database\QueryBuilder;

$app = [];

$app['config'] = require 'config.php';

//require 'core/Router.php';
//
//require 'core/Request.php';

$app['Database'] = new QueryBuilder(
	Connection::make($app['config']['Database'])
);
