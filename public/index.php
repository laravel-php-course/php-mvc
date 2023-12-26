<?php


use App\app\controllers\AuthController;
use App\app\controllers\SiteController;
use App\configs\BaseConfig;
use App\core\Application;
use App\core\Log;
use App\database\Connection;

date_default_timezone_set('Asia/Tehran');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() != PHP_SESSION_ACTIVE)
{
    session_start();
}

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app->router->get('/', [SiteController::class, 'Home']);
$app->router->get('/user', 'user');
$app->router->get('/contact', [SiteController::class, 'ShowContactForm']);
$app->router->post('/contact', [SiteController::class, 'HandleContactForm']);
$app->router->get('/register', [AuthController::class, 'ShowRegisterForm']);
$app->router->post('/register', [AuthController::class, 'HandleRegister']);
$app->router->get('/login', [AuthController::class, 'ShowLoginForm']);
$app->router->post('/login', [AuthController::class, 'HandleLogin']);
$app->router->get('/profile', [AuthController::class, 'ShowProfile']);
$app->router->get('/logOut', [AuthController::class, 'HandleLogOut']);
$app->run();
