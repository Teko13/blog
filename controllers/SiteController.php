<?php

namespace App\controllers;

use App\src\Request;



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
        return $this->render('contact', []);
    }
}

?>
