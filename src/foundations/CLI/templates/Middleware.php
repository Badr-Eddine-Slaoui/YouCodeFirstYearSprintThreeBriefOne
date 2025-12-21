<?php

namespace App\Middlewares;

use Closure;
use Foundations\Middlewares\Middleware;
use Foundations\Request\Request;

class MiddlewareName extends Middleware{
    public function handle(Request $request, Closure $next){
        return $next($request);
    }
}