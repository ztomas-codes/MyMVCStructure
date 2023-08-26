<?php

namespace Database;
use Models\Model;
use PDO;
use PDOException;

class Database
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $password;
    /**
     * @var PDO
     */
    private $connection;

    /**
     * @var string
     */
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

    /**
     * @param Model $model
     * @return void
     */
    public function addNewModel(Model $model) : void
    {
        $tableName = $model->getTableName();
        $fields = $model->getFieldsAsSQL();
        $values = $model->getValuesAsSQL();

        $sql = "INSERT INTO $tableName ($fields) VALUES ($values)";
        $this->connection->exec($sql);
    }

    /**
     * @param Model $model
     * @return void
     */
    public function saveModel(Model $model) : void
    {
        $id = $model->id;
        $tableName = $model->getTableName();
        $fields = $model->getFieldsAsSQL();
        $values = $model->getValuesAsSQL();
        $sql = "UPDATE $tableName SET ($fields) VALUES ($values) WHERE id = $id";
    }

    /**
     * @param $id
     * @param $classOfModel
     * @return Model
     */
    public function getModelById($id, $classOfModel) : Model
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

    /**
     * @param $paramValue
     * @param $classOfModel
     * @return Model
     */
    public function getModelByParam($paramValue, $classOfModel) : ?Model
    {
        $tableName = (new $classOfModel())->getTableName();
        $sql = "SELECT * FROM $tableName WHERE ";
        foreach ($paramValue as $key => $value) {
            $sql .= "$key = '$value' AND ";
        }
        $sql = rtrim($sql, "AND ");
        $result = $this->connection->query($sql);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        if ($result == false) return null;
        $model = new $classOfModel();
        foreach ($result as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }
}