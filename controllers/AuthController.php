<?php

namespace App\controllers;

use App\models\User;
use App\src\Application;
use App\src\Request;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if ($request->isPostMethod()) {
            var_dump($request->getBody());
            exit;
        }
        return $this->render("login", []);
    }

    public function signup(Request $request)
    {
        $user = new User();
        if ($request->isPostMethod()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->register()) {
                Application::$app->mailer->sendvalidationrequest([$user->firstName, $user->lastName, $user->email]);
                Application::$app->session->setFlash("success", "Merci pour l'inscription");
                Application::$app->response->redirect('/login');
            }
            return $this->render("signup", [
                "model" => $user
            ]);
        }
        return $this->render("signup", ['model' => $user]);
    }
}