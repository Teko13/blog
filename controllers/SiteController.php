<?php

namespace App\controllers;

use App\models\User;
use App\src\Request;
use App\src\Application;

class SiteController extends Controller
{

    public function contact()
    {
        return $this->render('contact', []);
    }

    public function home()
    {
        if (isset($_SESSION['user'])) {
            switch ($_SESSION['user']['type']) {
                case User::STATUS_VALIDE:
                    Application::$app->controller->layout = "auth";
                    break;
                case User::STATUS_ADMIN:
                    Application::$app->controller->layout = 'admin';
                    break;

                default:
                    Application::$app->controller->layout = 'main';
                    break;
            }
        }
        return $this->render('home', []);
    }

    public function handlerContact(Request $request)
    {
        $dataParams = $request->getBody();
        var_dump($dataParams);
        exit;
        return $this->render('contact', []);
    }
}

?>