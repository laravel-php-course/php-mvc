<?php

namespace App\app\models;

use App\core\BaseModel;

class Massage extends BaseModel
{

    public function tableName()
    {
        return 'msg' ;
    }

    public array $attributes;

    public function __construct()
    {

        $this->attributes = ['Subject', 'Email', 'Body'];
    }

}