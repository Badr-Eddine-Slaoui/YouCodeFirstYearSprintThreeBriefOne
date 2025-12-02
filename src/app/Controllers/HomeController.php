<?php

namespace App\Controllers;

class HomeController extends Controller {
    public function index() {
        view('index');
    }

    public function services() {
        view('services');
    }

    public function about() {
        view('about');
    }

    public function contact() {
        view('contact');
    }
}