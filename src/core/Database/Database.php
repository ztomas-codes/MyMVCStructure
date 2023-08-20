<?php

namespace Database;
use PDO;
use PDOException;

class Database
{
    private $host;
    private $user;
    private $password;
    private $connection;
    private $dbName;

    public function __construct()
    {
        $config = getConfig();
        $this->host = $config['database']['host'];
        $this->user = $config['database']['user'];
        $this->password = $config['database']['pwd'];
        $this->dbName = $config['database']['dbName'];

        try {
            $this->connection = new PDO(
                "mysql:host=$this->host;dbname=$this->dbName",
                $this->user,
                $this->password
            );
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function save($model)
    {
        $tableName = $model->getTableName();
        $fields = $model->getFieldsAsSQL();
        $values = $model->getValuesAsSQL();
        $sql = "INSERT INTO $tableName ($fields) VALUES ($values)";
        $this->connection->exec($sql);
    }

    public function getModelById($id, $classOfModel)
    {
        $tableName = (new $classOfModel())->getTableName();
        $sql = "SELECT * FROM $tableName WHERE id = $id";
        $result = $this->connection->query($sql);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $model = new $classOfModel();
        foreach ($result as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }

    public function getModelByParam($paramValue, $classOfModel)
    {
        //paramValue is an array of key value pairs
        $tableName = (new $classOfModel())->getTableName();
        $sql = "SELECT * FROM $tableName WHERE ";
        foreach ($paramValue as $key => $value) {
            $sql .= "$key = '$value' AND ";
        }
        $sql = rtrim($sql, "AND ");
        $result = $this->connection->query($sql);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $model = new $classOfModel();
        foreach ($result as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }
}