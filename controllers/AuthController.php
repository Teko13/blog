<?php

namespace App\controllers;

use App\models\User;
use App\src\Request;
use App\models\Login;
use App\src\Application;

class AuthController extends Controller
{

    public string $layout;

    public function login(Request $request)
    {
        $loginUser = new Login();
        if ($request->isPostMethod()) {
            $loginUser->loadData($request->getBody());
            if ($loginUser->validate() && $loginUser->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }
        return $this->render("login", ['model' => $loginUser]);
    }

    public function logout()
    {
        Application::$app->logout();
        return Application::$app->response->redirect('/');

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