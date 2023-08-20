<?php
namespace Models;
class Model
{

    protected $tableName;

    public function __toString()
    {

        $string = "";
        foreach ($this as $key => $value) {
            //ignore tableName and id
            if ($key == "tableName" || $key == "id") {
                continue;
            }
            $string .= "$key = '$value',";
        }
        $string = rtrim($string, ",");
        return $string;
    }


    public function getValuesAsSQL()
    {
        $string = "";
        foreach ($this as $key => $value) {
            //ignore tableName and id
            if ($key == "tableName" || $key == "id") {
                continue;
            }
            $string .= "'$value',";
        }
        $string = rtrim($string, ",");
        return $string;
    }

    public function getFieldsAsSQL()
    {
        $string = "";
        foreach ($this as $key => $value) {
            //ignore tableName and id
            if ($key == "tableName" || $key == "id") {
                continue;
            }
            $string .= "$key,";
        }
        $string = rtrim($string, ",");
        return $string;
    }

    public function getTableName()
    {
        return $this->tableName;
    }
}