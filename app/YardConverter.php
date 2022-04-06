<?php

class YardConverter
{
	public function measurementUnit($dimensionValue): float
	{
		# 1 metre = 1.09361

		return $dimensionValue / 1.09361;
	}
}
