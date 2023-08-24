<?php
namespace Controllers;
use Views\View;


class HomeController extends Controller
{

    /**
     * @param $params
     * @return void
     */
    public function index($params) : void
    {
        $view = new View("index", $this);
        $user = null;
        if (isset($_SESSION["loggedUser"])) $user = $this->getDb()->getModelById($_SESSION["loggedUser"], "Models\\User");
        $view->setData("user", $user);
        $view->render();
    }
}