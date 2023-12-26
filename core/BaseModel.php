<?php

namespace App\core;

use App\database\Connection;

class BaseModel
{
    public static string $tableName = "users" ;
    public array $attributes;

    public function create($data): array|int|string|null
    {
        return Connection::db_insert($this->attributes, $data, self::$tableName);
    }

    public static function find($value, string $field = "ID"): bool|array|null
    {
        return Connection::db_select(self::$tableName, "$field='$value'");
        return  '';
    }

}