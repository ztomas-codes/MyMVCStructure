<?php
namespace Controllers;

use Database\Database;

class Controller
{
    /**
     * @var mixed
     */
    private $db;

    /**
     * @return Database
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db): void
    {
        $this->db = $db;
    }

    public function redirect($url) : void
    {
        header("Location: $url");
    }

}