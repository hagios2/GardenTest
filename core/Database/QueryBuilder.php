<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
	protected $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function select($sql, $parameters)
	{
		try {
			$statement = $this->pdo->prepare($sql);

			$statement->execute($parameters);

			return $statement->fetchAll(PDO::FETCH_CLASS);

		} catch (\Exception $e) {
			die($e->getMessage());
		}
	}

	public function insert($sql, $parameters)
	{

		try {
			$statement = $this->pdo->prepare($sql);

			$statement->execute($parameters);
		} catch (\Exception $e) {
			die($e->getMessage());
		}
	}
}
