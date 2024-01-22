<?php

namespace System;

class ResponseErrors
{
    public static function response500() {
        http_response_code(500);
        include_once(ROOT . '/Views/Errors/500.html');
        exit();
    }

    public static function response404() {
        http_response_code(404);
        include_once(ROOT . '/Views/Errors/404.html');
        exit();
    }
}