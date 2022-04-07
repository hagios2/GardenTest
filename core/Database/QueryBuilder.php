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

	public function selectAll()
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

	public function selectOne()
	{

		try {
			$sql = "SELECT * FROM gardens ORDER BY id DESC LIMIT 1";

			$statement = $this->pdo->prepare($sql);

			$statement->execute();

			return $statement->fetchAll(PDO::FETCH_CLASS)[0];

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
				':'. implode(', :', array_keys($parameters))
			);

			$statement = $this->pdo->prepare($sql);

			$statement->execute($parameters);

			return $this->pdo->lastInsertId();
		} catch (\Exception $e) {
			die($e->getMessage());
		}
	}
}
