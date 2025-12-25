<?php

namespace App\Controllers;

use App\Model\Admin;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Foundations\Controllers\Controller;
use Foundations\Request\Request;

class HomeController extends Controller {
    public function index() {
        $users = User::with("roles")->get();
        dd($users);
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