<?php

namespace App\app\controllers;

use App\core\BaseController;
use App\core\Request;

class SiteController extends BaseController
{
    public function Home(): bool|array|string
    {
        $param = [
            'name' => 'Farzad'
        ];

        return $this->render('home', $param);
    }

    public function ShowContactForm(Request $request)
    {
        return $this->render('contact', ['request' => $request]);
    }

    public function HandleContactForm(Request $request): bool|array|string
    {
        $request->loadData($request->getBody());
        $request->validate();

        return $this->render('contact', ['request' => $request]);
    }
}