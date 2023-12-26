<?php

namespace APP\app\models;

use App\core\BaseModel;

class user extends BaseModel
{
    public function tableName()
    {
        return 'users' ;
    }
    public array $attributes;

    public function __construct()
    {

        $this->attributes = ['Name', 'Email', 'Password'];
    }
    public static function login(array $data): bool
    {

        $user = self::find($data['Email'], 'Email');

        if (is_array($user) AND password_verify($data['Password'], $user['Password']))
        {
            $_SESSION['user'] = $user;
            header("Location: /");
        }

        return false;
    }
}