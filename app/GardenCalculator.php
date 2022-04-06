<?php

//namespace App;

class GardenCalculator
{
	protected Garden $garden;

	public function __construct(Garden $garden)
	{
		$this->garden = $garden;
	}

	public function loadView()
	{
		require 'views/home.php';
	}

	public function setMeasurementUnit($unit)
	{
		$this->garden->setMeasurementUnit($unit);
	}

	public function setDepthMeasurementUnit($unit)
	{
		$this->garden->setDepthUnit($unit);
	}

	public function setDimensions($width, $length, $depth)
	{
		$this->garden->setLength($length);

		$this->garden->setDepth($depth);

		$this->garden->setWidth($width);
	}

	public function calculateNumberOfBags()
	{

	}

	public function calculate()
	{
		$inputs = Request::input();

		$this->setMeasurementUnit($inputs['unitForDimensions']);

		$this->setDepthMeasurementUnit($inputs['unitForDepth']);

		$this->setDimensions($inputs['width'], $inputs['length'], $inputs['depth']);
	}

	public function save()
	{

	}
}
