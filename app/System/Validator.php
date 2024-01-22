<?php

namespace System;

class Validator
{
    public static function getData() {
        $data = [
        'title' => $_POST['title'],
        'year' => $_POST['year'],
        'pages' => $_POST['pages'],
        'isbn' => $_POST['isbn'],
        'author1' => $_POST['author1'],
        'author2' => $_POST['author2'],
        'author3' => $_POST['author3'],
        'description' => $_POST['description'],
        ];

        if (empty($data['title']) ||
            empty($data['author1']) ||
            empty($data['description']) ||
            !preg_match("/^[0-9]{4}$/", $data['year']) ||
            !preg_match("/^[0-9]+$/", $data['pages']) ||
            !preg_match("/^[0-9-]+$/", $data['isbn']))
        {
            ResponseErrors::response500();
        }

        return $data;
    }
}