<?php

//use Router;

$query = require 'bootstrap.php';

Router::load('routes.php')

	->direct(Request::url(), Request::method());
