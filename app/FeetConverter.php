<?php

namespace  App;

use App\Interfaces\Measurement as Measurement;

class FeetConverter implements Measurement
{
	public function measurementUnit($dimensionValue): float
	{
		# 1 metre = 3.28084 ft

		return $dimensionValue / 3.28084;
	}
}
