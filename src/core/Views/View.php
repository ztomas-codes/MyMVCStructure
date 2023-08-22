<?php

namespace Views;

class View
{
    private $name;
    private $controller;
    private $data;

    public function __construct($name, $controller = null)
    {
        $this->name = $name;
        $this->controller = $controller;
        $this->data = [];
    }

    /**
     * @param $name
     * @param $value
     * @return void
     */
    public function setData($name, $value) : void
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $template
     * @return void
     */
    public function render($template = true) : void
    {
        if ($template) include "./Views/Template/header.php";
        extract($this->data);

        if ($this->controller != null)
        {
            $controllerName = get_class($this->controller) ;

            $controllerName = str_replace("Controllers", "", $controllerName);
            $controllerName = str_replace("Controller", "", $controllerName);
            //remove first backslash
            $controllerName = substr($controllerName, 1);

            include("./Views/$controllerName/". ucfirst($this->name) . "View.php");
        }
        else
        {
            include("./Views/$this->name" . "View.php");
        }

        if ($template) include "./Views/Template/footer.php";
    }
}