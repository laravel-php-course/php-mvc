<?php

namespace APP\app\models;

use App\core\BaseModel;

class User extends BaseModel
{
    public string $tableName;
    public array $attributes;

    public function __construct()
    {
        $this->tableName  = 'users';
        $this->attributes = ['Name', 'Email', 'Password'];
    }
}