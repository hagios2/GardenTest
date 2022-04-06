<?php

namespace App;

use App\Interfaces\Measurement;

class YardConverter implements Measurement
{
	public function measurementUnit($dimensionValue): float
	{
		# 1 metre = 1.09361

		return $dimensionValue / 1.09361;
	}
}
