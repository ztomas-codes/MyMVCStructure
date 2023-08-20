<?php
namespace Controllers;
use Views\View;


class ErrorController extends Controller
{
    public function index($params)
    {
        $view = new View("index", $this);
        $view->setData("error", $params);
        $view->render();
    }
}