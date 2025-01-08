<?php 

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    // App
    "Database" => fn() => new app\core\Database,
    "Request" => fn() => new app\core\Request,
    
    // Your Models
    "Post" => fn() => new app\models\Post,
    "User" => fn() => new app\models\User,
]);

$container = $containerBuilder->build();

return $container;