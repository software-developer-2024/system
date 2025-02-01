<?php

use Core\App;
use Core\Database;

const BASE_PATH = __DIR__.'/../';
const PATH = __DIR__;

require BASE_PATH.'Core/Functions.php';

// dd(phpinfo());

spl_autoload_register(function ($class){
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new \Core\Router();

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);

unset($_SESSION['__flash']);

$db = App::resolve(Database::class);
$db->close();
 