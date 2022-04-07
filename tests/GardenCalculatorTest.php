<?php

namespace Test;

use App\Controllers\GardenCalculator;
use Core\Database\Connection;
use Core\ServiceContainer;
use Faker\Factory;
use Faker\Generator as Generator;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

require 'bootstrap.php';

class GardenCalculatorTest extends TestCase
{
    private GardenCalculator $gardenCalculator;
    private array $units;
    private float $randomLength;
    private float $randomWidth;
    private float $randomDepth;
    private Generator $faker;
    private $pdo;

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->pdo = Connection::make(ServiceContainer::get('config')['database']);
        $this->client = new Client(['base_uri' => 'http://localhost:8000']);
        $this->gardenCalculator = new GardenCalculator();
        $this->units = ['Centimetres', 'Inches', 'Yards', 'Feet', 'Metres'];
        $this->faker = Factory::create();
        $this->randomLength = $this->faker->randomFloat(2, 10, 100);
        $this->randomWidth = $this->faker->randomFloat(2, 10, 100);
        $this->randomDepth = $this->faker->randomFloat(2, 10, 100);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
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

        $this->assertSame(
            $this->randomDepth,
            $this->gardenCalculator->garden->getDepth()
        );

        $this->assertSame(
            $this->randomLength,
            $this->gardenCalculator->garden->getLength()
        );

        $this->assertSame(
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

        $this->assertSame(
            $this->randomDepth,
            $this->gardenCalculator->garden->getDepth()
        );

        $this->assertSame(
            $this->randomLength,
            $this->gardenCalculator->garden->getLength()
        );

        $this->assertSame(
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

        $numberOfBags = (int) round(($area * 0.025) * 1.4);

        $costOfBags = (float) $numberOfBags * 72;

        $this->assertSame(
            $numberOfBags,
            $this->gardenCalculator->garden->getNumberOfBags()
        );

        $this->assertSame(
            $costOfBags,
            $this->gardenCalculator->garden->getCost()
        );
    }

    public function test_object_gets_saved_in_the_db()
    {
        $measurementUnit = $this->units[array_rand($this->units)];
        $depthUnit = $this->units[array_rand($this->units)];

        $data = [
            'width' => $this->randomWidth,
            'length' => $this->randomLength,
            'depth' => $this->randomDepth,
            'unitForDimensions' => $measurementUnit,
            'unitForDepth' => $depthUnit,
			'addToBasket' => 'true'
        ];
        $headers = [
            'Accept' => 'application/json'
        ];

        $response = $this->client->request('POST', 'calculate', [
            'form_params' => $data,
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('width', $data['garden']);
        $this->assertArrayHasKey('length', $data['garden']);
        $this->assertArrayHasKey('depth', $data['garden']);
        $this->assertArrayHasKey('unit_of_dimensions', $data['garden']);
        $this->assertArrayHasKey('unit_of_depth', $data['garden']);
        $this->assertSame('success', $data['message']);

        #get the latest record in the db and run assertions
        $gardenObject = $this->gardenCalculator->garden->fetchLatest();

        $measurement = $this->gardenCalculator->measurementStrategy($measurementUnit);

        $lengthInMetres = $measurement->measurementUnit(
            $this->randomLength
        );

        $widthInMetres = $measurement->measurementUnit(
            $this->randomWidth
        );

        $area = $lengthInMetres * $widthInMetres;

        $numberOfBags = (int) round(($area * 0.025) * 1.4);

        $costOfBags = (float) $numberOfBags * 72;

        $this->assertSame($this->randomWidth, $gardenObject->width);
        $this->assertSame($this->randomDepth, $gardenObject->depth);
        $this->assertSame($this->randomLength, $gardenObject->length);
        $this->assertSame($measurementUnit, $gardenObject->unit_of_dimensions);
        $this->assertSame($depthUnit, $gardenObject->unit_of_depth);
        $this->assertSame($numberOfBags, $gardenObject->number_of_bags);
        $this->assertSame($costOfBags, $gardenObject->cost);
    }

	public function test_return_no_of_bags_and_cost_only_when_add_to_basket_is_false()
	{
		$measurementUnit = $this->units[array_rand($this->units)];
		$depthUnit = $this->units[array_rand($this->units)];

		$data = [
			'width' => $this->randomWidth,
			'length' => $this->randomLength,
			'depth' => $this->randomDepth,
			'unitForDimensions' => $measurementUnit,
			'unitForDepth' => $depthUnit,
			'addToBasket' => 'false'
		];
		$headers = [
			'Accept' => 'application/json'
		];

		$response = $this->client->request('POST', 'calculate', [
			'form_params' => $data,
			'headers' => $headers
		]);

		$this->assertEquals(200, $response->getStatusCode());
		$data = json_decode($response->getBody(), true);

		$this->assertArrayNotHasKey('width', $data['garden']);
		$this->assertArrayNotHasKey('length', $data['garden']);
		$this->assertArrayNotHasKey('depth', $data['garden']);
		$this->assertArrayHasKey('number_of_bags', $data['garden']);
		$this->assertArrayHasKey('cost', $data['garden']);
	}
}
