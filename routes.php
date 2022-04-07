<?php


use App\Controllers\GardenCalculator;

$router->post('calculate', GardenCalculator::class.'@calculate');

$router->get('', GardenCalculator::class.'@loadView');

$router->get('gardens', GardenCalculator::class.'@gardens');


