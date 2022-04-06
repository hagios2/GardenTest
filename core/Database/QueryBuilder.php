<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
	protected PDO $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function select()
	{
		try {
			$sql = "SELECT * FROM gardens ORDER BY id DESC";

			$statement = $this->pdo->prepare($sql);

			$statement->execute();

			return $statement->fetchAll(PDO::FETCH_CLASS);

		} catch (\Exception $e) {
			die($e->getMessage());
		}
	}

	public function insert($parameters)
	{
		try {
			$sql = sprintf(
				'INSERT INTO gardens (%s) values (%s)',
				implode(',', array_keys($parameters)),
				':'. implode(', :', array_values($parameters))
			);

			$statement = $this->pdo->prepare($sql);

			$statement->execute($parameters);
		} catch (\Exception $e) {
			die($e->getMessage());
		}
	}
}
