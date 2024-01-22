<?php

namespace Controllers;

use Models\AdminModel;
use System\Template;

class AdminController
{
    protected $admin_model;

    function __construct() {
        $this->admin_model = new AdminModel();
    }
    public function auth() {
        if (isset($_SERVER['PHP_AUTH_USER'])) {

            $login = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];
            $hash_password = $this->admin_model->getPass($login);

            if (password_verify($password, $hash_password)) {
                return true;
            } else {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo '<H1 style="text-align: center">incorrect username or password</H1>';
            }

        } else {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo '<H1 style="text-align: center">you need to log in</H1>';
        }
    }

    public function getPage() {
        if($this->auth()) {
            $books = $this->admin_model->all();
            $template = new Template();
            echo $template->getView('admin-template', $books);
        }
    }

    public function delete() {
        if($this->auth()) {
            $delete_id = (int)$_POST['id'];
            $this->admin_model->remove($delete_id);
            $page = $_SERVER['HTTP_REFERER'];
            header("Location: $page");
        }
    }

    public function addBook() {
        if($this->auth()) {
            $this->admin_model->addBook();
            $page = $_SERVER['HTTP_REFERER'];
            header("Location: $page");
        }
    }
}