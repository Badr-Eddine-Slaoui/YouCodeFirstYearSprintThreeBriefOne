<?php

namespace App;

use App\Middlewares\isAuthed;
use Foundations\Middlewares\Kernel as MiddlewaresKernel;

class Kernel extends MiddlewaresKernel
{
    
    protected static array $globalMiddleware = [

    ];

    protected static array $middlewareAliases = [
        
    ];

}