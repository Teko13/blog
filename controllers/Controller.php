<?php
namespace App\controllers;

class Controller
{


    public function render($view, $params)
    {
        return \App\src\Application::$app->router->renderView($view, $params);
    }

}