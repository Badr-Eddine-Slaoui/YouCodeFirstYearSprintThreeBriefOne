<?php

namespace App\Controllers;

use App\Requests\LoginRequest;
use Foundations\Controllers\Controller;
use Foundations\Helpers\Auth;
use Foundations\Request\Request;

class AuthController extends Controller {
    public function signup() {
        view('signup');
    }

    public function login() {
        view('login');
    }

    public function signupSubmit(Request $request) {
        $data = $request->except(["password_confirmation", "terms"]);
        if(Auth::register($data)) {
            redirect("login");
        } else {
            redirect("signup");
        }
    }

    public function loginSubmit(LoginRequest $request) {
        if(Auth::login($request->email, $request->password)) {
            redirect("index");
        } else {
            redirect("login");
        }
    }

    public function logout() {
        if(Auth::logout()) {
            redirect("login");
        } else {
            redirect("index");
        }
    }
}