<?php

namespace Service\Db;


use Service\DI\DI;
use PDO;
use PDOException;
use PDOStatement;

class Db
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * @var PDOStatement
     */
    private $stmt;

    /**
     * Db constructor.
     * @throws DbException
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=localhost;dbname=libraryDatabase',
                'libraryUser',
                'userPassword',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            throw new DbException('Could not connect to database: ' . $e->getMessage());
        }
    }

    /**
     * @param string $sql
     * @param array $fields
     * @return Db
     * @throws DbException
     */
    public function prepare($sql, $fields = [])
    {
        if($sql === '') {
            throw new DbException('No query is specified');
        }

        $this->stmt = $this->connection->prepare($sql);

        foreach ($fields as $field => $value) {
            $this->stmt->bindValue(':' . $field, $value);
        }

        return $this;
    }

    /**
     * @return Db
     * @throws DbException
     */
    public function run()
    {
        if (!$this->stmt) {
            throw new DbException('There is no query to run');
        }
        $this->stmt->execute();

        return $this;
    }

    /**
     * @return array
     * @throws DbException
     */
    public function one()
    {
        if (!$this->stmt) {
            throw new DbException('There is no data to output');
        }

        return $this->stmt->fetchObject();
    }

    /**
     * @return array
     * @throws DbException
     */
    public function all()
    {
        if (!$this->stmt) {
            throw new DbException('There is no data to output');
        }

        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return int
     * @throws DbException
     */
    public function lastInsertId():int
    {
        if (!$this) {
            throw new DbException('There is no data to output');
        }

        return $this->connection->lastInsertId();
    }
}