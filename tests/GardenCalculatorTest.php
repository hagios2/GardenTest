<?php

namespace Test;

use App\Controllers\GardenCalculator;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class GardenCalculatorTest extends TestCase
{
	private GardenCalculator $gardenCalculator;
	private array $units;
	private float $randomLength;
	private float $randomWidth;
	private float $randomDepth;

	protected function setUp(): void
	{
		$this->gardenCalculator = new GardenCalculator;
		$this->units = ['Centimetres', 'Inches', 'Yards', 'Feet', 'Metres'];
		$this->randomLength = mt_rand();
		$this->randomWidth = mt_rand();
		$this->randomDepth = mt_rand();
	}

	public function test_measurement_unit_gets_set()
	{
		$randomUnit = $this->units[array_rand($this->units)];

		$this->gardenCalculator->setMeasurementUnit($randomUnit);

		$this->assertSame(
			$randomUnit,
			$this->gardenCalculator->garden->getMeasurementUnit()
		);
	}

	public function test_depth_measurement_unit_gets_set()
	{
		$randomUnit = $this->units[array_rand($this->units)];

		$this->gardenCalculator->setDepthMeasurementUnit($randomUnit);

		$this->assertSame(
			$randomUnit,
			$this->gardenCalculator->garden->getDepthUnit()
		);
	}

	public function test_dimensions_gets_set()
	{
		$this->gardenCalculator->setDimensions(
			$this->randomWidth,
			$this->randomLength,
			$this->randomDepth
		);

		$this->assertEquals(
			$this->randomDepth,
			$this->gardenCalculator->garden->getDepth()
		);

		$this->assertEquals(
			$this->randomLength,
			$this->gardenCalculator->garden->getLength()
		);

		$this->assertEquals(
			$this->randomWidth,
			$this->gardenCalculator->garden->getWidth()
		);
	}

	public function test_calculate_number_of_bags()
	{
		$this->gardenCalculator->setDimensions(
			$this->randomWidth,
			$this->randomLength,
			$this->randomDepth
		);

		$this->assertEquals(
			$this->randomDepth,
			$this->gardenCalculator->garden->getDepth()
		);

		$this->assertEquals(
			$this->randomLength,
			$this->gardenCalculator->garden->getLength()
		);

		$this->assertEquals(
			$this->randomWidth,
			$this->gardenCalculator->garden->getWidth()
		);

		$randomUnit = $this->units[array_rand($this->units)];

		$this->gardenCalculator->setMeasurementUnit($randomUnit);

		$this->assertSame($randomUnit, $this->gardenCalculator->garden->getMeasurementUnit());

		$this->gardenCalculator->calculateNumberOfBags(
			$this->gardenCalculator->measurementStrategy($randomUnit)
		);
	}
}
