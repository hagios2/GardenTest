<?php

use App\Interfaces\Measurement as Measurement;

class InchesConverter implements Measurement
{
	public function measurementUnit($dimensionValue): float
	{
		# 1 metre = 39.3701 in

		return $dimensionValue / 39.3701;
	}
}
