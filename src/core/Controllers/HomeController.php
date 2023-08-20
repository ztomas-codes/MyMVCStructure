<?php
namespace Controllers;
use Views\View;


class HomeController extends Controller
{
    public function index($params)
    {
        $view = new View("index", $this);
        $view->setData("user", $this->getDb()->getModelById(1, "Models\\User"));
        $view->render();
    }

    public function whereis($params)
    {
        $view = new View("where", $this);
        $view->setData("user", $this->getDb()->getModelByParam(["username" => $params[0]], "Models\\User"));
        $view->render();
    }
}