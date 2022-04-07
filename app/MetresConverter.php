<?php

namespace App;

use App\Interfaces\Measurement;

class MetresConverter implements Measurement
{
	public function measurementUnit($dimensionValue): float
	{
		return round($dimensionValue, 4);
	}
}
