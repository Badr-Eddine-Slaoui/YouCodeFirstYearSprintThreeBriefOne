<?php

namespace Foundations\DB\Migrations;

class Column{
    public array $column = [];

    public function __construct(string $name) {
        $this->column["name"] = $name;
    }

    public function getName(): string{
        return $this->column["name"];
    }

    public function type(string $type): self {
        if(str_contains($type, "ENUM")) {
            $this->column["enum"] = true;
        }
        $this->column["type"] = $type;
        return $this;
    }

    public function size(int $size) : self {
        $this->column["size"] = $size;
        return $this;
    }

    public function default(mixed $default) : self {
        $this->column["default"] = $default;
        return $this;
    }

    public function unsigned() : self {
        $this->column["unsigned"] = true;
        return $this;
    }

    public function nullable(bool $nullable = true) : self {
        $this->column["nullable"] = $nullable;
        return $this;
    }

    public function unique() : self {
        $this->column["unique"] = true;
        return $this;
    }

    public function auto_increment() : self {
        $this->column["auto_increment"] = true;
        return $this;
    }

    public function primary_key() : self {
        $this->column["primary_key"] = true;
        return $this;
    }

    public function references(string $table, string $column) : self {
        $this->column["references"] = ["table" => $table, "column" => $column];
        return $this;
    }

    public function onDelete(string $onDelete) : self {
        $this->column["onDelete"] = $onDelete;
        return $this;
    }

    public function onUpdate(string $onUpdate) : self {
        $this->column["onUpdate"] = $onUpdate;
        return $this;
    }
}