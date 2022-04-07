<?php

namespace App\Interfaces;

interface Measurement
{
	public function measurementUnit($dimensionValue): float;
}
