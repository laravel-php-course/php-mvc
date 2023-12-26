<?php

namespace App\app\requests;


class LoginRequest extends \App\core\Request
{
    public string $Email;
    public string $Password;

    public function rules():array
    {
        return [
            'Password' => [self::RULE_REQUIRED],
            'Email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        ];

    }

}

