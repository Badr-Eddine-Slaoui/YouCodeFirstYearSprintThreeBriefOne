<?php

namespace Foundations\DB\GoldDigger;

class QueryBuilder{
    protected string $model;
    protected string $table;
    protected array $selects = [];
    protected array $wheres = [];
    protected array $orWheres = [];
    protected array $toUpdate = [];
    protected bool $toDelete = false;
    protected array $joins = [];
    protected ?int $limit = null;
}