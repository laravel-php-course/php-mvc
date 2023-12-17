<?php


use App\app\controllers\SiteController;
use App\configs\BaseConfig;
use App\core\Application;
use App\core\Log;

date_default_timezone_set('Asia/Tehran');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';
Log::error('test');
$app = new Application();

$app->router->get('/', [SiteController::class, 'Home']);
$app->router->get('/user', 'user');
$app->router->get('/contact', 'contact');
$app->router->post('contact', [SiteController::class, 'HandleContactForm']);
$app->run();
