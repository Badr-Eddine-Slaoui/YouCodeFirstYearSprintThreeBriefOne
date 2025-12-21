<?php

namespace Foundations\Middlewares\Pipeline;

use Closure;
use Foundations\Request\Request;

class Pipeline
{
    protected array $middlewares = [];
    protected Request $request;

    public function send(Request $request): static
    {
        $this->request = $request;
        return $this;
    }

    public function through(array $middlewares): static
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    public function then(Closure $destination)
    {
        $pipeline = array_reduce(
            array_reverse($this->middlewares),
            function ($next, $middleware) {
                return function ($request) use ($middleware, $next) {
                    return (new $middleware)->handle($request, $next);
                };
            },
            $destination
        );

        return $pipeline($this->request);
    }
}
