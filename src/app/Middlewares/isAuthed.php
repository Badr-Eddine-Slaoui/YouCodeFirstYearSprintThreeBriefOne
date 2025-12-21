<?php

namespace App\Middlewares;

use Closure;
use Foundations\Helpers\Auth;
use Foundations\Middlewares\Middleware;
use Foundations\Request\Request;

class isAuthed extends Middleware{
    public function handle(Request $request, Closure $next){
        if(!Auth::check()){
            redirect("login");
        }

        return $next($request);
    }
}