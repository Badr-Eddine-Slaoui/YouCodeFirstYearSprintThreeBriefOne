<?php

namespace App\Controllers;

class HomeController extends Controller {
    public function index() {
        $this->view('index');
    }

    public function services() {
        $this->view('services');
    }

    public function about() {
        $this->view('about');
    }

    public function contact() {
        $this->view('contact');
    }
}