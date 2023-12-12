<?php

use App\configs\BaseConfig;

class Connection
{
    public function connect()
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

            $mysqli->real_connect( $configs['Host'], $configs('User'), $configs('Pass'), $configs('Name'));

            if (!is_null($mysqli->connect_error))
                $this->connect();

            return $mysqli;

        }
        catch (Exception $exception)
        {
            //Log
        }
    }
}