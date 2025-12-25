<?php

namespace Foundations\DB\GoldDigger\Relationships;

class BelongsTo extends Relation {
    public function get(){
        return $this->related::query()->where($this->localKey, "=", $this->parent->{$this->foreignKey})->first();
    }

    public function first(){
        return $this->get();
    }

    public function where($column, $operator, $value = null){
        return $this->related::query()->where($this->localKey,"=", $this->parent->{$this->foreignKey})
                    ->where($column, $operator, $value);
    }
}