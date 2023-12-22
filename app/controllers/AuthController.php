<?php

namespace App\app\controllers;

use App\core\BaseController;
use App\core\Request;
use App\app\models\User;
use App\app\requests\RegisterRequest;

class AuthController extends BaseController
{
    public function showLoginForm(): bool|array|string
    {
        return $this->render('login');
    }

    public function showRegisterForm(Request $request): bool|array|string
    {

        return $this->render('register', ['request' => $request]);
    }

    public function handleLogin(Request $request): bool|array|string
    {
//
//        $loginRequest = new LoginRequest();
//        $loginRequest->loadData($request->getBody());
//
//        if ($loginRequest->validate())
//        {
//            if (User::login(['email' => $loginRequest->email, 'password' => $loginRequest->password]))
//            {
//                $this->redirect('/');
//                return true;
//            }
//            else
//            {
//                $loginRequest->addError('email', 'The information are not correct');
//            }
//        }
//
//        return $this->render('login', [
//            'request' => $loginRequest
//        ]);
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

}