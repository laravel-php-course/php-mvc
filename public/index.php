<?php


use App\configs\BaseConfig;

date_default_timezone_set('Asia/Tehran');

require_once __DIR__.'/../vendor/autoload.php';

var_dump(BaseConfig::getConfigs('APP_NAME'));

echo "<h1>Home Page</h1>";
