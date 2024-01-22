<?php

error_reporting(0);

define("ROOT", dirname(__DIR__));

spl_autoload_register(function($name){
    $path = ROOT . '/' . str_replace('\\', '/', $name) . '.php';
    if(file_exists($path)){
        include_once($path);
    }
});

use System\ResponseErrors;
use System\Router;

set_exception_handler(function (Throwable $e) {
    $log = date('Y-m-d H:i:s') . $e;
    file_put_contents(ROOT . '/log.txt', $log . PHP_EOL, FILE_APPEND);
    ResponseErrors::response500();
});

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$route = Router::getRoute($method, $uri);

if ($route !== null) {
    $controller = new $route['controller']();
    $action = $route['action'];
    $controller->$action();
} else {
    http_response_code(404);
    include_once(ROOT . '/Views/Errors/404.html');
    exit();
}