<?php

namespace System;

use PDO;
use Exception;

const DB_HOST = 'db';
const DB_NAME = 'Booklibrary';
const DB_USER = 'root';
const DB_PASS = 'secret_password';

class Database
{
    protected $db;

    public function __construct() {
        try{
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (Exception $e) {
            ResponseErrors::response500();
        }
    }

    public function query($query,$params = []) {
        try {
            $query = $this->db->prepare($query);
            $query->execute($params);
            return $query;
        } catch (Exception $e) {
            ResponseErrors::response500();
        }
    }

    public function lastInsertId() {
        try{
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            ResponseErrors::response500();
        }
    }

    public function getPDO() {
        return $this->db;
    }
}
