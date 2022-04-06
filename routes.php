<?php


//use App\GardenCalculator;
//echo GardenCalculator::class;

$router->get('', GardenCalculator::class, 'loadView');
$router->post('', GardenCalculator::class);


