<?php

namespace App\app\requests;

use App\core\Request;

class ContactRequest extends Request
{
    public string $Subject;
    public string $Email;
    public string $Body;

    public function rules():array
    {
        return [
            'Subject' => [self::RULE_REQUIRED],
            'Email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'Body' => [self::RULE_REQUIRED]
        ];
    }
}