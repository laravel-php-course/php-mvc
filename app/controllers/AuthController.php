<?php

namespace App\app\controllers;

use App\app\requests\LoginRequest;
use App\core\BaseController;
use App\core\Log;
use App\core\Request;
use App\app\models\User;
use App\app\requests\RegisterRequest;

class AuthController extends BaseController
{
    public function showLoginForm(Request $request): bool|array|string
    {
        return $this->render('login', ['request' => $request]);
    }

    public function showRegisterForm(Request $request): bool|array|string
    {

        return $this->render('register', ['request' => $request]);
    }
    public function ShowProfile(Request $request): bool|array|string
    {

        return $this->render('profile', ['request' => $request]);
    }


    public function handleLogin(Request $request): bool|array|string
    {

        $loginRequest = new LoginRequest();
        $loginRequest->loadData($request->getBody());

        if ($loginRequest->validate())
        {
            if (User::login(['Email' => $loginRequest->Email, 'Password' => $loginRequest->Password]))
            {
                $this->redirect('/');
                return true;

            }

            else
            {
                die(var_dump($loginRequest->Email , $loginRequest->Password));
            }
        }

        return $this->render('login', [
            'request' => $loginRequest
        ]);
        return false;
    }

    public function handleRegister(Request $request): bool|array|string
    {

        $registerRequest = new RegisterRequest();
        $registerRequest->loadData($request->getBody());

        if ($registerRequest->validate())
        {
            $user = (new User)->create([
                'Name' => $registerRequest->Name,
                'Email' => $registerRequest->Email,
                'Password' => password_hash($registerRequest->Password, PASSWORD_DEFAULT)
            ]);

            if (is_array($user))
            {
//                Application::$app->session->setFlash('success', 'Welcome to our site');
                $_SESSION['user'] = $user;
                header("Location: /");
            }
            else
            {
                echo '<pre>';
                var_dump($user);
                die('</pre>');
            }

        }

        return $this->render('register', [
            'request' => $registerRequest
        ]);
    }
    public function HandleLogOut(Request $request): bool|array|string
    {
        return $request ; //just for not being empty
    }

}