<?php

use App\Controllers\GardenCalculator;

$router->post('calculate', GardenCalculator::class.'@calculateOrAddToBasket');

$router->get('', GardenCalculator::class.'@loadView');

$router->get('gardens', GardenCalculator::class.'@gardens');


