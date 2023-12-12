<?php

namespace App\core;

use App\configs\BaseConfig;

class Log
{
    public static function info($message)
    {
        $log_dir    = BaseConfig::getConfigs('BASE_DIR') . "\\logs\\";

        if (!file_exists($log_dir)) {
            mkdir($log_dir, 0777, true); // 0777 provides full permissions; adjust as needed
        }

        $today      = date('Y-m-d');
        $filePath   = $log_dir . $today."info.log";
        $message    = '[' . date('H:i:s') . '] - ' . $message . PHP_EOL;

        file_put_contents($filePath, $message, FILE_APPEND);
    }

}