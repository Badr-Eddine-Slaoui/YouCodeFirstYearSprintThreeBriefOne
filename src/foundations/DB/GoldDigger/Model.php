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

    protected static function pluralize(string $name): string
    {
        return match (true) {
            str_ends_with($name, 'y') => substr($name, 0, -1) . 'ies',
            str_ends_with($name, 's') => "{$name}es",
            default => "{$name}s",
        };
    }
}