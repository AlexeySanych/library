<?php

namespace System;

class Template
{
    protected function render($tpl, $content) {

        if(file_exists(ROOT . '/Views/' . $tpl . '.php')) {
            ob_start();
            require ROOT . '/Views/' . $tpl . '.php';
            return ob_get_clean();
        } else {
            return null;
        }
    }

    public function getView($tpl, $content) {
        $body = $this->render($tpl, $content);
        return $this->render('general-template', $body);
    }
}