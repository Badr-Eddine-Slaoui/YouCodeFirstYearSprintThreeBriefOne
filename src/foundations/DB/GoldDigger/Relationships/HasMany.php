<?php

namespace Foundations\DB\GoldDigger\Relationships;

class HasMany extends Relation {
    public function get(){
        return $this->related::query()->where($this->foreignKey,"=", $this->parent->{$this->localKey})->get();
    }

    public function first(){
        return $this->get()[0];
    }

    public function where($column, $operator, $value = null){
        return $this->related::query()->where($this->foreignKey,"=", $this->parent->{$this->localKey})
                    ->where($column, $operator, $value);
    }
}