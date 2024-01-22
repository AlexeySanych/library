<?php

namespace System;

use Controllers\BooksController;
use Controllers\AdminController;

class Router
{
    protected static $routes = [
        [
            'method' => "GET",
            'path' => "/^\/$|^\/\?page=[0-9]+$/",
            'controller' => BooksController::class,
            'action' => "getAll"
        ],
        [
            'method' => "GET",
            'path' => "/^\/book\/[0-9]+$/",
            'controller' => BooksController::class,
            'action' => "getBook"
        ],
        [
            'method' => "POST",
            'path' => "/^\/book\/[0-9]+$/",
            'controller' => BooksController::class,
            'action' => "counterClicks"
        ],
        [
            'method' => "GET",
            'path' => "/^\/search-book\?search=.+$/",
            'controller' => BooksController::class,
            'action' => "search"
        ],
        [
            'method' => "GET",
            'path' => "/^\/admin$|^\/admin\?page=[0-9]+$/",
            'controller' => AdminController::class,
            'action' => "getPage"
        ],
        [
            'method' => "POST",
            'path' => "/^\/admin$/",
            'controller' => AdminController::class,
            'action' => "addBook"
        ],
        [
            'method' => "GET",
            'path' => "/^\/admin\/logout$/",
            'controller' => AdminController::class,
            'action' => "logout"
        ],
        [
            'method' => "POST",
            'path' => "/^\/admin\/delete$/",
            'controller' => AdminController::class,
            'action' => "delete"
        ]
    ];

    public static function getRoute($method, $uri){
        foreach(static::$routes as $route) {
            if ($method == $route['method'] && preg_match($route['path'], $uri)) {
                return $route;
            }
        }
        return null;
    }

}