<?php

use Core\Request;
use Core\Router;

require 'vendor/autoload.php';
require 'bootstrap.php';

Router::load('routes.php')

	->direct(Request::url(), Request::method());
