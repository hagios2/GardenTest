<?php

namespace Test;

use App\Controllers\GardenCalculator;
use App\Models\Garden;
use Faker\Factory;
use Faker\Generator as Generator;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
//use PHPUnit\DbUnit\TestCaseTrait;

class GardenCalculatorTest extends TestCase
{
//	use TestCaseTrait;
	private GardenCalculator $gardenCalculator;
	private array $units;
	private float $randomLength;
	private float $randomWidth;
	private float $randomDepth;
	private Generator $faker;

	protected function setUp(): void
	{
		$this->gardenCalculator = new GardenCalculator;
		$this->units = ['Centimetres', 'Inches', 'Yards', 'Feet', 'Metres'];
		$this->faker = Factory::create();
		$this->randomLength = $this->faker->randomFloat(2, 10, 100);
		$this->randomWidth = $this->faker->randomFloat(2, 10, 100);
		$this->randomDepth = $this->faker->randomFloat(2, 10, 100);
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

		$this->assertSame(
			$randomUnit,
			$this->gardenCalculator->garden->getMeasurementUnit()
		);

		$measurement = $this->gardenCalculator->measurementStrategy($randomUnit);

		$this->gardenCalculator->calculateNumberOfBags(
			$measurement
		);

		$lengthInMetres = $measurement->measurementUnit(
			$this->randomLength
		);

		$widthInMetres = $measurement->measurementUnit(
			$this->randomWidth
		);

		$area = $lengthInMetres * $widthInMetres;

		$numberOfBags = round(($area * 0.025) * 1.4);

		$costOfBags = $numberOfBags * 72;

		$this->assertEquals(
			$numberOfBags,
			$this->gardenCalculator->garden->getNumberOfBags()
		);

		$this->assertEquals(
			$costOfBags,
			$this->gardenCalculator->garden->getCost()
		);
	}

	public function test_object_gets_saved_in_the_db()
	{
		$garden = $this->createMock(Garden::class);

		var_dump($garden->save());
		exit;

	}
}
