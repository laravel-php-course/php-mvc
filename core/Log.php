<?php

namespace App\core;

use App\configs\BaseConfig;

define('LOG_DIR', BaseConfig::getConfigs('BASE_DIR') . "\\logs\\");

class Log
{
    public static function info($message)
    {
        $today      = date('Y-m-d');
        $filePath   = LOG_DIR . $today."_info.log";
        $message    = '[' . date('H:i:s') . '] - ' . $message . PHP_EOL;

        file_put_contents($filePath, $message, FILE_APPEND);
    }
    public static function error($message)
    {

        $today      = date('Y-m-d');
        $filePath   = LOG_DIR . $today."_error.log";
        $message    = '[' . date('H:i:s') . '] - ' . $message . PHP_EOL;

        file_put_contents($filePath, $message, FILE_APPEND);
    }
}