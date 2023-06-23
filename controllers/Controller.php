<?php
namespace App\controllers;

use App\models\User;
use App\src\Application;

class Controller
{

    public string $layout;


    public function render($view, $params)
    {
        return Application::$app->router->renderView($view, $params);
    }

}