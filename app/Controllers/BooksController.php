<?php
namespace Controllers;

use Models\BooksModel;
use System\Template;

class BooksController
{
    protected $books_model;
    protected $template;

    function __construct() {
        $this->books_model = new BooksModel();
        $this->template = new Template();
    }
    public function getAll() {
        $books =  $this->books_model->all();
        echo $this->template->getView('books-template', $books);
    }

    public function getBook() {
        $path = explode('/', $_SERVER['REQUEST_URI']);
        $bookId = (int)$path[2];
        $book =  $this->books_model->get($bookId);
        echo $this->template->getView('book-template', $book);
    }

    public function counterClicks() {
        $click_id = (int)$_POST['clickId'];
        $this->books_model->counter($click_id);
    }

    public function search() {
        $text_search = $_GET['search'];
        $result_search =  $this->books_model->search($text_search);
        echo $this->template->getView('books-template', $result_search);
    }
}