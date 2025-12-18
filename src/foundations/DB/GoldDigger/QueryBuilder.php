<?php

namespace Foundations\DB\GoldDigger;

use Foundations\DB\Database;
use Foundations\DB\Grammars\Grammar;
use Foundations\DB\Grammars\PostgresGrammar;

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

    public function __construct(string $model)
    {
        $this->model = $model;
        $this->table = $this->table = $model::table();
    }

    protected function execute(string $sql, array $bindings = []): ?array
    {
        $db = new Database();
        $stmt = $db->prepare($sql);
        $stmt->execute($bindings);

        $result = $stmt->fetch();

        $db = null;

        return $result ?: null;
    }

    protected function executeAll(string $sql, array $bindings = []): array
    {
        $db = new Database();
        $stmt = $db->prepare($sql);
        $stmt->execute($bindings);

        $db = null;

        return $stmt->fetchAll();
    }

    protected function grammar(): Grammar
    {
        return new PostgresGrammar();
    }

    public function select(string|array $column, ?string $alias = null): self
    {
        if (is_string($column)) {
            $this->selects[$column] = $alias;
        } else {
            foreach ($column as $key => $value) {
                if (is_int($key)) {
                    $this->selects[$value] = null;
                } else {
                    $this->selects[$key] = $value;
                }
            }
        }
        return $this;
    }

    public function selects(): array{
        return count($this->selects) > 0 ? $this->selects : ['*' => null];
    }

    public function where(string|array $column, $value = null): self
    {
        if (is_string($column)) {
            if (isset($value)) {
                $this->wheres[$column] = $value;
            }
        } else {
            $this->wheres = array_merge($this->wheres, $column);
        }
        return $this;
    }

    public function orWhere(string|array $column, $value = null): self
    {
        if (is_string($column)) {
            if (isset($value)) {
                $this->orWheres[$column] = $value;
            }
        } else {
            $this->orWheres = array_merge($this->orWheres, $column);
        }
        return $this;
    }

    public function first(): ?Model
    {
        $this->limit = 1;

        $sql = $this->grammar()->select($this->table, $this->selects(), $this->wheres, $this->orWheres, $this->limit);
        $row = $this->execute($sql, array_values(array_merge($this->wheres, $this->orWheres, [$this->limit])));

        return $row ? new $this->model($row) : null;
    }
}