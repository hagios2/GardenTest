<?php

namespace Core\Database;

use PDO;
use PDOException;

class Connection extends PDO
{
    public static function make($config)
    {
        try {
            $pdo = new PDO(
                $config['connection'] . ';dbname=' . $config['dbname'],
                $config['username'],
                $config['password'],
                $config['options']
            );

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);

            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
