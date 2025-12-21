<?php

namespace App\Controllers;

use App\Models\User;
use Foundations\Controllers\Controller;
use Foundations\Request\Request;

class UserController extends Controller {
    public function profile(User $user) {
        view('profile', compact('user'));
    }

    public function update(Request $request, User $user) {
        $user->update(["id" => $user->id], $request->inputs());
        session()->flash("success","Profile updated successfully!");
        redirect('profile', ['user'=> $user->id]);
    }
}