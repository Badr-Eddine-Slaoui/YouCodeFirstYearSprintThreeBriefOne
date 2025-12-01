<?php

namespace App\Controllers;

class Controller {
    public function view($view, $data = []) {
        extract($data);
        require_once __DIR__.'/../../views/'.$view.'.php';
    }
}