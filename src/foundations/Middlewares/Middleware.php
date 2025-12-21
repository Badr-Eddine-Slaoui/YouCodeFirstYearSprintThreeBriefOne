<?php

namespace Foundations\Middlewares;

use Foundations\Request\Request;
use Closure;

abstract class Middleware
{
    abstract public function handle(Request $request, Closure $next);

}