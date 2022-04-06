<?php

use App\Interfaces\Measurement as Measurement;

class CentimeterConverter implements Measurement
{
	public function measurementUnit($dimensionValue): float
	{
		# 1 metre = 100 cm

		return $dimensionValue / 100;
	}
}
