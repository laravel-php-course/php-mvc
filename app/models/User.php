<?php

namespace APP\app\models;

use App\core\BaseModel;

class user extends BaseModel
{
    public static string $tableName;
    public array $attributes;

    public function __construct()
    {
self::$tableName = 'users';
        $this->attributes = ['Name', 'Email', 'Password'];
    }
    public static function login(array $data): bool
    {
        self::$tableName = 'users';
        $user = self::find($data['Email'], 'Email');

        if (is_array($user) AND password_verify($data['Password'], $user['Password']))
        {
            $_SESSION['user'] = $user;
            header("Location: /");
        }

        return false;
    }
}