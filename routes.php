<?php

//use App\GardenCalculator;
//echo GardenCalculator::class;
$router->post('calculate', GardenCalculator::class.'@calculate');

$router->get('', GardenCalculator::class.'@loadView');


