<?php 

ini_set('error_reporting', E_ALL);

require_once "vendor/autoload.php";
require_once "helpers/functions.php";
require_once "config/Container.php";

use app\core\Router;
use app\controllers\HomeController;

$router = new Router();

$router->addRoute("GET","/",HomeController::class,"index");
$router->addRoute("GET","/home",HomeController::class,"home");
$router->addRoute("GET","/post/add",HomeController::class,"create");
$router->addRoute("POST","/post/add",HomeController::class,"store");

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $container);
