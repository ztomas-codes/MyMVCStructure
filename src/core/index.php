<?php


define("PATH", "http://localhost/");

function getConfig()
{
    return include('./config.php');
}

spl_autoload_register(function ($class) {

    require './' . str_replace('\\', '/', $class) . '.php';
});

function controllerExists($class)
{
    return file_exists('./' . str_replace('\\', '/', $class) . '.php');
}

new Core();