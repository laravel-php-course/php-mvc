<?php

namespace App\app\controllers;

use App\app\models\Massage;
use APP\app\models\user;
use App\app\requests\ContactRequest;
use App\app\requests\RegisterRequest;
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
            $contact = (new Massage)->create([
                'Subject' => $contactRequest->Subject,
                'Email' => $contactRequest->Email,
                'Body' => $contactRequest->Body
            ] );

            if (is_array($contact))
            {
                $_SESSION['contact'] = $contact;
                header("Location: /");
            }
            else
            {
                echo '<pre>';
                var_dump($contact);
                die('</pre>');
            }

        }

        return $this->render('contact', [
            'request' => $contactRequest
        ]);
    }

}