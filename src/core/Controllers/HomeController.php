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

    public function poradi($params)
    {
        $view = new View("poradi", $this);
        $view->setData("user", $this->getDb()->getModelByParam(["username" => $params[0]], "Models\\User"));
        $view->render();
    }
}