<?php

namespace App\Controllers;

use App\Request\Request;

class HomeController extends Controller {
    public function index(Request $request) {
        echo '<pre>';
        var_dump($request->all());
        echo '</pre>';
        view('index');
    }

    public function services(Request $request) {
        view('services');
    }

    public function about(Request $request) {
        view('about');
    }

    public function contact(Request $request) {
        view('contact');
    }
}