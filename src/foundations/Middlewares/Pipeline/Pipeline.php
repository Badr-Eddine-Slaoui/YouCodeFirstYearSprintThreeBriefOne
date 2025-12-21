<?php

namespace Foundations\Middlewares\Pipeline;

use Closure;
use Foundations\Request\Request;

class Pipeline
{
    protected array $middlewares = [];
    protected Request $request;
}
