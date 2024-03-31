<?php

namespace App\Core\Database;

use App\Core\Config\ConfigInterface;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
    private \PDO $pdo;

    public function __construct(
        private readonly ConfigInterface $config
    ) {
        $this->connect();
    }

    public function insert(string $table, array $data): int|false
    {
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(static fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$binds})";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (PDOException $e) {
            echo "Query failed: {$e->getMessage()}";

            return false;
        }

        return $this->pdo->lastInsertId();
    }

    private function connect()
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $dbname = $this->config->get('database.dbname');
        $port = $this->config->get('database.port');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new PDO(
                "mysql:host=$host; port = $port; dbname=$dbname; charset=$charset", $username, $password
            );
        } catch (PDOException $e) {
            exit("Database connection failed: {$e->getMessage()}");
        }
    }
}
