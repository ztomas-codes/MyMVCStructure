<?php
namespace Controllers;
use Views\View;


class ErrorController extends Controller
{
    /**
     * @param $params
     * @return void
     */
    public function index($params) : void
    {
        $view = new View("index", $this);
        $view->setData("error", $params);
        $view->render();
    }
}