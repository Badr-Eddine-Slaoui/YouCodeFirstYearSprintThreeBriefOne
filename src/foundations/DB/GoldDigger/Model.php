<?php

namespace Foundations\DB\GoldDigger;

class Model{
    protected static ?string $table = null;
    public array $attributes = [];

    public function __construct(array $attributes = [])
    {
        
    }

    private static function class_basename(string $class): string
    {
        return basename(str_replace('\\', '/', $class));
    }
}