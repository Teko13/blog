<?php

namespace App\controllers;

use App\models\User;
use App\controllers\Controller;
use App\src\Application;

class AdminController extends Controller
{
    public function adminDashbord()
    {
        return $this->render('adminDashBoard', []);
    }
    public function authorization()
    {
        if (Application::$app->session->get('user')) {
            if (Application::$app->session->get('user')['type'] === User::STATUS_ADMIN) {
                Application::$app->layout = 'admin';
                return true;
            } else {
                Application::$app->response->setStatusCode(401);
                //return $this->render('_401', []);
                return false;
            }
        } else {
            Application::$app->response->redirect('/login');
        }
    }
    public function __construct()
    {
        if ($this->authorization() === false) {
            echo $this->render('_401', []);
            exit;
        }
    }
}