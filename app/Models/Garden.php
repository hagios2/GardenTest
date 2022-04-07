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
	private float $cost;
	private QueryBuilder $queryBuilder;
	private int $id;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}

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

	public function save(): array
	{
		$data = [
			'length' => $this->length,
			'width' => $this->width,
			'depth' => $this->depth,
			'number_of_bags' => $this->numberOfBags,
			'cost' => $this->cost,
			'unit_of_depth' => $this->depthUnit,
			'unit_of_dimensions' => $this->measurementUnit
		];

		$id = $this->queryBuilder->insert($data);

		$this->setId($id);

		$data['id'] = $id;

		return $data;
	}

	public function fetchAll()
	{
		return $this->queryBuilder->select();
	}

	/**
	 * @return float
	 */
	public function getCost(): float
	{
		return $this->cost;
	}

	/**
	 * @param float $cost
	 */
	public function setCost(float $cost): void
	{
		$this->cost = $cost;
	}

}
