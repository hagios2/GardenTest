<?php

namespace  App\Models;

require 'bootstrap.php';

use Core\Database\QueryBuilder;
use Core\ServiceContainer;

class Garden
{
	private float $length;
	private float $width;
	private float $depth;
	private string $depthUnit;
	private string $measurementUnit;
	private int $numberOfBags;
	private QueryBuilder $queryBuilder;

	public function __construct()
	{
		$this->queryBuilder = ServiceContainer::get('database');
	}

	/**
	 * @return float
	 */
	public function getLength(): float
	{
		return $this->length;
	}

	/**
	 * @param float $length
	 */
	public function setLength(float $length): void
	{
		$this->length = $length;
	}

	/**
	 * @return float
	 */
	public function getWidth(): float
	{
		return $this->width;
	}

	/**
	 * @param float $width
	 */
	public function setWidth(float $width): void
	{
		$this->width = $width;
	}

	/**
	 * @return float
	 */
	public function getDepth(): float
	{
		return $this->depth;
	}

	/**
	 * @param float $depth
	 */
	public function setDepth(float $depth): void
	{
		$this->depth = $depth;
	}

	/**
	 * @return string
	 */
	public function getDepthUnit(): string
	{
		return $this->depthUnit;
	}

	/**
	 * @param string $depthUnit
	 */
	public function setDepthUnit(string $depthUnit): void
	{
		$this->depthUnit = $depthUnit;
	}

	/**
	 * @return string
	 */
	public function getMeasurementUnit(): string
	{
		return $this->measurementUnit;
	}

	/**
	 * @param string $measurementUnit
	 */
	public function setMeasurementUnit(string $measurementUnit): void
	{
		$this->measurementUnit = $measurementUnit;
	}

	/**
	 * @return int
	 */
	public function getNumberOfBags(): int
	{
		return $this->numberOfBags;
	}

	/**
	 * @param int $numberOfBags
	 */
	public function setNumberOfBags(int $numberOfBags): void
	{
		$this->numberOfBags = $numberOfBags;
	}

	public function save()
	{
		die(var_dump($this));
		$this->queryBuilder->insert($this);
	}

	public function fetchAll()
	{
		return $this->queryBuilder->select();
	}

}
