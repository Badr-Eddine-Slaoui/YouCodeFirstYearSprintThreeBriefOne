<?php

namespace Foundations\Middlewares;

use Closure;
use Foundations\Middlewares\Pipeline\Pipeline;
use Foundations\Request\Request;

abstract class Kernel{
    protected static array $globalMiddleware = [];
    protected static array $middlewareAliases = [];
    private static array $middleware = [];

    public static function setMiddleware(string $middleware): void{
        self::$middleware[] = static::$middlewareAliases[$middleware] ?? $middleware;
    }
}