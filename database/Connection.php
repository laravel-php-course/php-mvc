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
            //TODO Kourosh Add Log
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
}