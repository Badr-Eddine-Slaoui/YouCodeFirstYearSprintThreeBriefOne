<?php

namespace Foundations\DB\GoldDigger\Relationships;

use Foundations\DB\GoldDigger\Model;

abstract class Relation {
    protected Model $parent;
    protected string $related;
    protected string $localKey;
    protected string $foreignKey;

    public function __construct($related, $parent, $localKey = 'id', $foreignKey = null)
    {
        $this->parent = $parent;
        $this->related = $related;
        $this->foreignKey = $foreignKey ?? strtolower(Model::class_basename($parent::class)) . '_id';
        $this->localKey = $localKey;
    }

    abstract public function get();

    abstract public function first();

    abstract public function where($column, $operator, $value = null);
}