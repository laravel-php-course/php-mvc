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

    public function HandleContactForm()
    {

    }
}