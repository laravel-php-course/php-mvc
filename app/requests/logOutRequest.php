<?php

namespace App\app\requests;

class logOutRequest extends \App\core\Request
{
    public string $Name;
    public string $Email;
    public string $Password;

    public function rules():array
    {
        return [
            'Name' => [self::RULE_REQUIRED],
            'Email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'Password' => [self::RULE_REQUIRED]
        ];
    }
}