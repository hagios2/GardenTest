<?php

use Core\Database\Connection;
use Core\Database\QueryBuilder;
use Core\ServiceContainer;

ServiceContainer::bind('config', require 'config.php');

ServiceContainer::bind('database', new QueryBuilder(
	Connection::make(ServiceContainer::get('config')['database'])
));
