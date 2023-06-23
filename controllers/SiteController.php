<?php

namespace App\controllers;



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

    public function handlerContact(Request $request)
    {
        //$dataParams = $request->getBody();
        return $this->render('contact', []);
    }
}

?>