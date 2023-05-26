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
        $data = [
            "name" => "Fabio"
        ];
        return $this->render('home', $data);
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