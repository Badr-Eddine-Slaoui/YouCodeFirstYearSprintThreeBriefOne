<?php

namespace App\Controllers;

use App\Model\Admin;
use Foundations\Controllers\Controller;
use Foundations\Request\Request;

class HomeController extends Controller {
    public function index(Request $request, Admin $admin) {
        $admin = $admin->update(["id" => $admin->id], ["column_1" => "updated", "column_0"=> "updated"])[0];
        $admin = $admin->delete(["id" => $admin->id])[0];
        $attr = $admin->attributes;
        unset($attr["id"]);
        $admin = $admin->create($attr);
        echo "Its here finally <br>";
        var_dump($admin);
        die();
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