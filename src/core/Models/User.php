<?php
namespace Models;
class User extends Model
{
    /**
     * @var string
     */
    public $tableName = "users";

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $password;

    /**
     * @var
     */
    public $email;
}