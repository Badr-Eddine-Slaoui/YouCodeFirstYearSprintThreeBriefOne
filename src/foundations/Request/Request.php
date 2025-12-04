<?php

namespace Foundations\Request;

class Request {
    public function uri() {
        return $_SERVER['REQUEST_URI'];
    }

    public function method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function all() {
        $request = array_merge($_SERVER, $_REQUEST, $_GET, $_POST, $_FILES, $_COOKIE);
        return $request;
    }

    public function inputs(){
        if ($this->isPost()) {
            return $_POST;
        }
        return $_GET;
    }

    public function input($key) {
        return $_REQUEST[$key];
    }

    public function file($key) {
        return $_FILES[$key];
    }

    public function header($key) {
        return $_SERVER[$key];
    }

    public function cookie($key) {
        return $_COOKIE[$key];
    }

    public function session($key) {
        return $_SESSION[$key];
    }

    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isPut() {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
    }

    public function isDelete() {
        return $_SERVER['REQUEST_METHOD'] === 'DELETE';
    }

    public function isPatch() {
        return $_SERVER['REQUEST_METHOD'] === 'PATCH';
    }
}