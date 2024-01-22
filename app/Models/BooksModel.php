<?php

namespace Models;

use System\ResponseErrors;

class BooksModel extends Model
{
    public function get(int $id) {
        $array_db = $this->db->query("SELECT books.*,GROUP_CONCAT(authors.author) AS authors
            FROM books
            JOIN books_authors ON books.id = books_authors.book_id
            JOIN authors ON books_authors.author_id = authors.id
            WHERE  books.id = :id", ['id' => $id])->fetch();

        if ($array_db['id']) {
            $this->db->query("UPDATE books SET views = views + 1 WHERE id = :id", ['id' => $id]);
            return $array_db;
        }else {
            ResponseErrors::response404();
        }
    }

    public function counter($id) {
            $this->db->query("UPDATE books SET clicks = clicks + 1 WHERE id = :id", ['id' => $id]);
    }

    public function search($text_search) {
        $stmt = $this->db->query("SELECT books.id, books.title,
            GROUP_CONCAT(authors.author) AS authors
            FROM books 
            JOIN books_authors ON books.id = books_authors.book_id
            JOIN authors ON books_authors.author_id = authors.id
            WHERE books.title LIKE ?
            GROUP BY books.id", ["%$text_search%"])->fetchAll();;
        return $stmt;
    }
}