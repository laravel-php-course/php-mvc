<?php

namespace App\configs;

require_once "app.php";
require_once "database.php";

class BaseConfig
{
    private static array $configs;

    /**
     * @return string|null
     */
    public static function getConfigs($key): ?string
    {
        if (empty(self::$configs))
            self::setConfigs();

        return self::$configs[$key] ?? null;
    }

    /**
     * @return void
     */
    private static function setConfigs(): void
    {
        self::$configs = [
            'DB_HOST' => HOST,
            'DB_NAME' => NAME,
            'DB_PASS' => PASSWORD,
            'DB_USER' => USERNAME,
            'APP_NAME'=> APP_NAME,
            'APP_PORT'=> PORT,
            'BASE_DIR'=> BASE_DIR,
            'APP_URL' => APP_URL
        ];
    }


}