<?php

namespace Foundations\DB\GoldDigger\Relationships;

class BelongsToMany extends Relation {
    private string $pivot_table;
    private string $relatedLocalKey;
    private string $relatedForeignKey;

    public function __construct($related, $pivot_table, $parent, $localKey, $foreignKey, $relatedLocalKey, $relatedForeignKey)
    {
        parent::__construct($related, $parent, $localKey, $foreignKey);
        $this->pivot_table = $pivot_table;
        $this->relatedForeignKey = $relatedForeignKey;
        $this->relatedLocalKey = $relatedLocalKey;
    }
    public function get(){
        $relatedTableName = $this->related::table();
        $localKeyValue = $this->parent->{$this->localKey};

        return $this->related::query()->select("{$relatedTableName}.*")
                        ->join($this->pivot_table, "{$relatedTableName}.{$this->relatedLocalKey}", '=', "{$this->pivot_table}.{$this->relatedForeignKey}")
                        ->where("{$this->pivot_table}.{$this->foreignKey}", '=', $localKeyValue)
                        ->get();
    }

    public function first(){
        return $this->get()[0];
    }

    public function where($column, $operator, $value = null){
        $relatedTableName = $this->related::table();
        $localKeyValue = $this->parent->{$this->localKey};

        return $this->related::query()->select("{$relatedTableName}.*")
                        ->join($this->pivot_table, "{$relatedTableName}.{$this->relatedLocalKey}", '=', "{$this->pivot_table}.{$this->relatedForeignKey}")
                        ->where("{$this->pivot_table}.{$this->foreignKey}", '=', $localKeyValue)
                        ->where($column, $operator, $value);
    }
}