<?php

namespace App\Controllers;

use App\Model\Admin;
use Foundations\Controllers\Controller;
use Foundations\Request\Request;

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