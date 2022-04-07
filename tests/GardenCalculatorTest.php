<?php

namespace Test;

use App\Controllers\GardenCalculator;
use PHPUnit\Framework\TestCase;

class GardenCalculatorTest extends TestCase
{
	public function test_it_parses_a_single_tag()
	{
		$result = $this->call();

		$expected = ['personal'];

		$this->assertSame($expected, $result);
	}
}
