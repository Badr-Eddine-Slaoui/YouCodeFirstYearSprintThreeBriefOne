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
}
