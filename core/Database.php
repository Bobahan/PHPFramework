<?php

namespace PHPFramework;

class Database
{
    private \PDO $connection;
    private \PDOStatement $stmt; // подготовленные выражения, чтобы не было SQL иньекций 
    public function __construct()
    {
        $this->setDatabaseConnection();
    }

    public function setDatabaseConnection()
    {
        $dsn = "mysql:host=" . DB_SETTINGS['host'] . ";dbname=" . DB_SETTINGS['database'] . ";charset=" . DB_SETTINGS['charset'];
        try {
            $this->connection = new \PDO($dsn, DB_SETTINGS['username'], DB_SETTINGS['password'], DB_SETTINGS['options']);
        } catch (\PDOException $e) {
            abort('DB error connection', 500);
        }
        return $this;
    }

    public function query(string $query, array $params = [])
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);

        return $this;
    }

    public function getAll()
    {
        return $this->stmt->fetchAll();
    }

    public function getAssoc($key = 'id')
    {
        $data = [];

        while($row = $this->stmt->fetch()) {
            $data[$row[$key]] = $row;
        }

        return $data;
    }

    public function getOne()
    {
        return $this->stmt->fetch();
    }

    public function getColumn()
    {
        return $this->stmt->fetchColumn();
    }

    public function findAll($table)
    {
        $this->query("SELECT * FROM $table");

        return $this->getAll();
    }

    public function findOne($table, $value, $key = 'id')
    {
        $this->query("SELECT * FROM $table WHERE $key = ? LIMIT 1", [$value]);

        return $this->getOne();
    }

    public function findOrFail($table, $value, $key = 'id')
    {
        $res = $this->findOne($table, $value, $key);

        if(!$res) {
            abort();
        }

        return $res;
    }

    public function getLastInsertedId()
    {
        return $this->connection->lastInsertId();
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function rollback()
    {
        return $this->connection->rollBack();
    }
}