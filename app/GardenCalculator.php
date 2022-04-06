<?php

//namespace App;

class GardenCalculator
{
	public function loadView()
	{
		require 'views/home.php';

	}

	public function setMeasurementUnit()
	{

	}

	public function setDepthMeasurementUnit()
	{

	}

	public function setDimension()
	{

	}

	public function calculateNumberOfBags()
	{

	}

	public function calculate()
	{
		header('Content-Type:application/json');
		echo json_encode(Request::input());
//		$this->setMeasurementUnit();
	}

	public function save()
	{

	}
}
