<?php

namespace App\database;

use App\configs\BaseConfig;
use App\core\Log;
use Exception;
use mysqli;

class Connection
{
    /** @var mysqli $connection */
    private static mysqli $connection;

    private function __construct()
    {
    }

    public static function create(): mysqli|false
    {
        if (self::isConnected())
            return self::$connection;

        return self::connect();
    }

    private static function connect(): mysqli|bool
    {
        $configs = [
            'Host' => BaseConfig::getConfigs('DB_HOST'),
            'Name' => BaseConfig::getConfigs('DB_NAME'),
            'Pass' => BaseConfig::getConfigs('DB_PASS'),
            'User' => BaseConfig::getConfigs('DB_USER')
        ];

        try{
            $mysqli = mysqli_init();

            mysqli_options($mysqli, MYSQLI_OPT_CONNECT_TIMEOUT, 120);
            mysqli_options($mysqli, MYSQLI_OPT_READ_TIMEOUT, 10);
            mysqli_options($mysqli, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, true);


            
            $mysqli->real_connect($configs['Host'], $configs['User'], $configs['Pass'], $configs['Name']);

            if (!is_null($mysqli->connect_error))
            {
                Log::error("DB Connection Failed, {$mysqli->connect_error}, " . mysqli_error($mysqli));
                self::connect();
            }

            self::$connection = $mysqli;
            $dblog = 'you connect to database '.$configs['Name'].'ّ in '. date('d-H:i:s') . ' succsessfully';
            Log::info($dblog);
        }
        catch (Exception $exception)
        {
            $errorMessage = "Error: {$exception->getMessage()}, Line: {$exception->getLine()}, File: {$exception->getFile()}, DB Params:" .
                print_r($configs, true);
            Log::error($errorMessage);
        }

        return self::$connection ?? false;
    }

    private static function isConnected(): bool
    {
        if (!empty(self::$connection) AND self::$connection->ping())
        {
            return true;
        }

        return false;
    }
    
    public static function query(string $sql): array //All SELECT queries must be used
    {
        $result = [];
        $conn = self::create();

        try {
            $stmt = $conn->query($sql);
            while (@$row = mysqli_fetch_array($stmt, MYSQLI_ASSOC))
            {
                $result[] = $row;
            }
        }
        catch (Exception $exception)
        {
            $errorMessage = "Error: {$exception->getMessage()}, Line: {$exception->getLine()}";
            Log::error($errorMessage);
        }
        return $result;
    }

    public static function queryFirst(string $sql): bool|array|null
    {
        $conn = self::create();
        return $conn->query($sql)->fetch_assoc();
    }

    public static function db_insert(array $attributes, array $data, string $table): array|int|string|null
    {
        $conn = self::create();
        $sql  = "INSERT INTO $table SET ";

        foreach($attributes as $attribute)
        {
            $sql .= "`{$attribute}` = '{$data[$attribute]}', ";
        }

        $sql = rtrim($sql, ", ");

        try {
            $result = $conn->query($sql);

            if ($result)
            {
                if ($conn->insert_id != 0)
                    return self::db_select($table, "ID={$conn->insert_id}", 'ID, Name, Email');
                
                return self::db_select($table, "", 'ID, Name, Email');

            }

            Log::error("Error Query: `$sql`, ". print_r([$conn, $result], true));
        }
        catch (Exception $exception)
        {
            Log::error($exception->getMessage());
        }

        return null;
    }

    public static function db_select(string $table, string $condition = null, $field = '*', $fetchAll = false, $orderBy = 'ID', $orderType = 'DESC'): bool|array|null //TODO Add Limit Params
    {
        $field = is_array($field) ? implode(', ', $field) : $field;
        $where = $condition ? " WHERE $condition" : '';
        $sql   = "SELECT {$field} FROM `$table` $where";
        $sql  .= " ORDER BY $orderBy $orderType";
        $sql  .= $fetchAll ? ';' : ' LIMIT 1;';

        return $fetchAll ? self::query($sql) : self::queryFirst($sql);
    }
}
