<?php

namespace App\controllers;

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
        return $this->render('home', []);
    }

    public function handlerContact(Request $request): void
    {
        try {
            $requestBody = Application::$app->request->getBody();
            $name = $requestBody["name"];
            $email = $requestBody["email"];
            $message = $requestBody['message'];
            $mailData = array($name, $email, $message);
            Application::$app->mailer->sendContactMessage($mailData);
            Application::$app->session->setFlash("success", "Votre message a bien été envoyer! 👌🏿");
            Application::$app->response->redirect("/");
        } catch (\Throwable $th) {
            Application::$app->response->setStatusCode(500);
            echo $this->render('_500', []);
        }
    }
}

?>
