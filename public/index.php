<?php


use App\configs\BaseConfig;
use App\core\Application;
use App\core\Log;

date_default_timezone_set('Asia/Tehran');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';
Log::info('test');
$app = new Application();

$app->router->get('/', function () {
    echo "<h1>Home</h1>";
});
$app->router->get('/user', function () {
    echo "<h1>User</h1>";
});

$app->run();
Log::info('test21');