<?php

namespace Models;

use System\ResponseErrors;
use System\Validator;
use Throwable;

class AdminModel extends Model
{
    public function getPass($login) {
        return $this->db->query("SELECT password FROM users WHERE username = ?", [$login])->fetchColumn();
    }

    public function remove($id) {
        try {
            if (file_exists('img/' . $id . '.jpg')) {
                unlink('img/' . $id . '.jpg');
            }
            $this->db->getPDO()->beginTransaction();
            $this->db->query("DELETE books, books_authors FROM books JOIN books_authors ON books.id = books_authors.book_id WHERE books.id = :id", ['id' => $id]);
            $this->db->query("DELETE authors FROM authors LEFT JOIN books_authors ON authors.id = books_authors.author_id WHERE book_id IS NULL");
            $this->db->getPDO()->commit();
        } catch (Throwable $e) {
            $this->db->getPDO()->rollBack();
            ResponseErrors::response500();
        }
    }

    public function addBook() {
        try {
            $this->db->getPDO()->beginTransaction();
            $validData = Validator::getData();
            extract($validData);
            $this->db->query("INSERT INTO books(title, description, year, pages, isbn) VALUES(:title, :description, :year, :pages, :isbn)",
                ['title' => $title, 'description' => $description, 'year' => $year, 'pages' => $pages, 'isbn' => $isbn]);
            $id_book = $this->db->lastInsertId();
            $this->add_author($author1, $id_book);
            if (!empty($author2)) {
                $this->add_author($author2, $id_book);
            }
            if (!empty($author3)) {
                $this->add_author($author3, $id_book);
            }
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                $array = explode(".", $_FILES['image']['name']);
                $extension = end($array);
                if ($extension == 'jpg') {
                    move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $id_book . '.jpg');
                } else {
                    ResponseErrors::response500();
                }
            }
            $this->db->getPDO()->commit();
        } catch (Throwable $e) {
            $this->db->getPDO()->rollBack();
            ResponseErrors::response500();
        }
    }

    private function add_author($author, $id_book) {
        $stmt = $this->db->query("SELECT COUNT(author) FROM authors WHERE author =:author", ['author' => $author]);
        $isset_author = $stmt->fetchColumn();

        if (!$isset_author) {
            $stmt = $this->db->query("INSERT INTO authors(author) VALUES (:author)", ['author' => $author]);
            $id_author = $this->db->lastInsertId();
        } else {
            $stmt = $this->db->query("SELECT id FROM authors WHERE author =:author", ['author' => $author]);
            $id_author = $stmt->fetchColumn();
        }
        $this->db->query("INSERT INTO books_authors(book_id, author_id) VALUES(:book_id, :author_id)", ['book_id' => $id_book, 'author_id' => $id_author]);
    }
}