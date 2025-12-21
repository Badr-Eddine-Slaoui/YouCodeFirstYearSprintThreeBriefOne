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
    
    public static function handle(Request $request, Closure $controller)
    {
        return (new Pipeline)
            ->send($request)
            ->through(array_merge(static::$globalMiddleware, self::$middleware))
            ->then($controller);
    }
}