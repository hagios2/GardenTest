<?php

namespace App\Controllers;

use App\CentimeterConverter;
use App\FeetConverter;
use App\InchesConverter;
use App\Interfaces\Measurement;
use App\MetresConverter;
use App\Models\Garden;
use App\YardConverter;
use Core\Request;

class GardenCalculator
{
	public Garden $garden;

	public function __construct()
	{
		$this->garden = new Garden;
	}

	public function loadView()
	{
		require 'views/home.php';
	}

	public function gardens()
	{
		header('Content-Type:application/json');

		echo json_encode(['gardens' => $this->garden->fetchAll()]);
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

	public function calculateNumberOfBags(Measurement $measurement)
	{
		$lengthInMetres = $measurement->measurementUnit($this->garden->getLength());

		$widthInMetres = $measurement->measurementUnit($this->garden->getWidth());

		$area = $lengthInMetres * $widthInMetres;

		$numberOfBags = round(($area * 0.025) * 1.4);

		$cost = $numberOfBags * 72;

		$this->garden->setNumberOfBags($numberOfBags);

		$this->garden->setCost($cost);
	}

	public function measurementStrategy($unit): Measurement
	{
		switch ($unit) {
			case 'Centimetres':
				return new CentimeterConverter;
			case 'Inches':
				return new InchesConverter;
			case 'Yards':
				return new YardConverter;
			case 'Feet':
				return new FeetConverter;
			default:
				return new MetresConverter;
		}
	}

	public function calculate()
	{
		$inputs = Request::input();

		$this->setMeasurementUnit($inputs['unitForDimensions']);

		$this->setDepthMeasurementUnit($inputs['unitForDepth']);

		$this->setDimensions($inputs['width'], $inputs['length'], $inputs['depth']);

		$measurement = $this->measurementStrategy($inputs['unitForDimensions']);

		$this->calculateNumberOfBags($measurement);

		$garden = $this->save();

		header('Content-Type:application/json');

		echo json_encode(['message' => 'success', 'garden' => $garden]);
	}

	public function save(): array
	{
		return $this->garden->save();
	}
}
