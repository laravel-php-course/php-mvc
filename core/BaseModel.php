<?php

namespace App\core;

use App\database\Connection;

class BaseModel
{

    public function tableName() {
    }
public array $attributes;

    public function create($data): array|int|string|null
    {
        return Connection::db_insert($this->attributes, $data, $this->tableName());

    }

    public function find($value, string $field = "ID"): bool|array|null
    {
        return Connection::db_select($this->tableName(), "$field='$value'");
        return  '';
    }


}