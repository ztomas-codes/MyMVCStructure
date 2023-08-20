<?php

use Database\Database;
use Controllers\Controller;

class Core
{
    public function __construct()
    {

        $db = new Database();


        $url = explode("/", $_SERVER['REQUEST_URI']);

        if (!empty($url[1])) $controllerName = "Controllers\\" . ucfirst($url[1]) . "Controller";
        else $controllerName = "Controllers\\HomeController";
        $action = $url[2] ?? "index";

        //if url is longer than 3, then it contains parameters so we need to extract them and pass them to the controller separately
        if (count($url) > 3)
        {
            $params = array_slice($url, 3);
        }
        else
        {
            $params = [];
        }

        if(!controllerExists($controllerName))
        {
            $controller = new Controllers\ErrorController();
            $controller->index("Page not found");
            return;
        }

        $controller = new $controllerName();
        $controller->setDb($db);
        if (!method_exists($controller, $action)) 
        {
            
            $controller = new Controllers\ErrorController();
            $controller->index("Page not found");
            return;
        }

        $controller->$action($params);


    }
}