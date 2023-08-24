<?php
namespace Models;
class Model
{

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @return string
     */
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


    /**
     * @return string
     */
    public function getValuesAsSQL() : string
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

    /**
     * @return string
     */
    public function getFieldsAsSQL() : string
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

    /**
     * @return string
     */
    public function getTableName() : string
    {
        return $this->tableName;
    }
}