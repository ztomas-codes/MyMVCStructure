<?php
session_start();


//it will look like http://localhost:8080 but dynamic
define("FULL_PATH", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

function getConfig()
{
    return include('./config.php');
}

spl_autoload_register(function ($class) {

    require './' . str_replace('\\', '/', $class) . '.php';
});

function controllerExists($class) : bool
{
    return file_exists('./' . str_replace('\\', '/', $class) . '.php');
}

function makeControllerUrl($controllerName = "home", $action = "index") : string
{
    return FULL_PATH."$controllerName/$action";
}

function getAssets(){
    return FULL_PATH."/assets";
}

new Core();