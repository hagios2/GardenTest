<?php

namespace  App;

use App\Interfaces\Measurement as Measurement;

class CentimeterConverter implements Measurement
{
	public function measurementUnit($dimensionValue): float
	{
		# 1 metre = 100 cm

		return round($dimensionValue / 100, 4);
	}
}
