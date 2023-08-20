<?php
namespace Models;
class User extends Model
{
    public $tableName = "users";
    public $id;
    public $username;
    public $password;
}