<?php
namespace Controllers;
use Models\User;

class TestController extends Controller
{
    public function newUser($params)
    {
        $user = new User();
        $user->username = $params[0];
        $user->password = "test";
        $this->getDb()->save($user);
    }
}