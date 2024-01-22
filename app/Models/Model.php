<?php

namespace Models;

use System\Database;
use System\ResponseErrors;

abstract class Model
{
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function all() {
    $limit = 10;
    $page_number = $_GET['page'] ?? 1;
	$count_pages = 0;
    $count_entry = $this->db->query("SELECT COUNT(*) FROM books")->fetchColumn();
    if ($count_entry == 0) {return 0;}
	$query_basic = 'SELECT books.id, books.title, books.year, books.clicks,
		GROUP_CONCAT(authors.author) AS authors
		FROM books 
		JOIN books_authors ON books.id = books_authors.book_id
		JOIN authors ON books_authors.author_id = authors.id
		GROUP BY books.id';
        if ($count_entry > $limit) {
            $count_pages = ceil($count_entry / $limit);
            if ($page_number > $count_pages) {
                ResponseErrors::response404();
            }
            $offset = $limit * $page_number - $limit;
            $query_basic = $query_basic . " LIMIT $limit OFFSET $offset";
        }
    $array_db = $this->db->query("$query_basic")->fetchAll();
	$array_db[0]['page'] = $page_number;
	$array_db[0]['count_pages'] = $count_pages;
    return $array_db;
    }
}
