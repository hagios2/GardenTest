<?php

//use Router;

//$query = require 'core/bootstrap.php';

Router::load('routes.php')

	->direct(Request::url(), Request::method());
