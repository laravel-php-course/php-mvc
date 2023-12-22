<?php

namespace App\app\controllers;

use App\app\requests\ContactRequest;
use App\core\BaseController;
use App\core\Log;
use App\core\Request;

class SiteController extends BaseController
{
    public function Home(): bool|array|string
    {
        $param = [
            'name' => isset($_SESSION['user']) ? $_SESSION['user']['Name'] : 'Guest'
        ];
        return $this->render('home', $param);
    }

    public function ShowContactForm(Request $request): bool|array|string
    {
        return $this->render('contact', ['request' => $request]);
    }

    public function HandleContactForm(Request $request): bool|array|string
    {
        $contactRequest = new ContactRequest();
        $contactRequest->loadData($request->getBody());

        if ($contactRequest->validate())
        {
            // TODO Add msg to db
            /*$contactRequest->emptyFields();*/ //TODO complete
            return $this->render('contact', ['request' => $contactRequest]);
        }
        return $this->render('contact', ['request' => $contactRequest]);
    }
}