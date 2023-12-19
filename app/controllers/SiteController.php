<?php

namespace App\app\controllers;

use App\core\BaseController;

class SiteController extends BaseController


{
    public function Home(): bool|array|string
    {
        $param = [
            'name' => 'Farzad'
        ];

        return $this->render('home', $param);
    }
    public function user(): bool|array|string
    {
        $param = [
            'name' => 'Farzad'
        ];

        return $this->render('user', $param);
    }

    public function contact(): bool|array|string
    {
        $param = [
            'name' => 'Farzad'
        ];

        return $this->render('contact', $param);
    }


    public function HandleContactForm()
    {

$param= [

    "subject" => $_POST['subject'],
    "email" => $_POST['email'],
    "body" => $_POST['body']

];
        return $this->render('form', $param);
    }
}