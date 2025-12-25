<?php

namespace Foundations\DB\GoldDigger;

use Foundations\DB\Database;
use Foundations\DB\Grammars\Grammar;
use Foundations\DB\Grammars\PostgresGrammar;

class QueryBuilder{
    protected string $model;
    protected string $table;
    protected array $selects = [];
    protected ?array $count = [];
    protected ?array $avg = [];
    protected ?array $sum = [];
    protected ?array $min = [];
    protected ?array $max = [];
    protected array $wheres = [];
    protected array $orWheres = [];
    protected array $toUpdate = [];
    protected bool $toDelete = false;
    protected array $joins = [];
    protected array $orders = [];
    protected array $groups = [];
    protected array $havings = [];
    protected array $orHavings = [];
    protected ?int $offset = null;
    protected ?int $limit = null;
    protected array $eagerLoading = [];

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

    public function count(?string $column = null, ?string $alias = null): self
    {
        if(isset($column)){
            $this->count[$column] = $alias;
        }else{
            $this->count["*"] = $alias;
        }
        return $this;
    }

    public function avg(string $column, ?string $alias = null): self
    {
        $this->avg[$column] = $alias;

        return $this;
    }

    public function sum(string $column, ?string $alias = null): self
    {
        $this->sum[$column] = $alias;
        
        return $this;
    }

    public function min(string $column, ?string $alias = null): self
    {
        $this->min[$column] = $alias;

        return $this;
    }

    public function max(string $column, ?string $alias = null): self
    {
        $this->max[$column] = $alias;

        return $this;
    }

    public function orderBy(string $column, string $order = "ASC"): self
    {
        $this->orders[$column] = $order;

        return $this;
    }

    public function groupBy(string $column, string $order = "ASC"): self
    {
        $this->groups[$column] = $order;

        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->wheres[$column] = [$operator, $value];
        return $this;
    }

    public function orWhere(string $column , string $operator, $value): self
    {
        $this->wheres[$column] = [$operator, $value];

        return $this;
    }

    public function having(string $column, string $operator, $value): self
    {
        $this->havings[$column] = [$operator, $value];

        return $this;
    }

    public function orHaving(string $column, string $operator, $value): self
    {
        $this->orHavings[$column] = [$operator, $value];

        return $this;
    }

    public function first(): ?Model
    {
        $this->limit = 1;

        $sql = $this->grammar()->select($this->table, $this->selects(), $this->count, $this->avg, $this->sum, $this->min, $this->max, $this->joins, $this->wheres, $this->orWheres, $this->groups, $this->havings, $this->orHavings, $this->orders, $this->offset, $this->limit);
        $row = $this->execute($sql, $this->bindings());

        return $row ? new $this->model($row) : null;
    }

    public function last(): ?Model
    {
        $sql = $this->grammar()->select($this->table, $this->selects(), $this->count, $this->avg, $this->sum, $this->min, $this->max, $this->joins, $this->wheres, $this->orWheres, $this->groups, $this->havings, $this->orHavings, $this->orders, $this->offset, $this->limit);
        $row = $this->execute($sql, $this->bindings());

        return $row ? new $this->model($row) : null;
    }

    private function flaten($array){
        return array_merge(array_map(fn($item) => $item[1], array_values($array)));
    }

    private function bindings(){
        return array_values(array_merge($this->flaten($this->wheres), $this->flaten($this->orWheres), $this->flaten($this->havings), $this->flaten($this->orHavings), $this->offset ? [$this->offset] : [], $this->limit ? [$this->limit] : []));
    }

    public function with(string $relation): static{
        $this->eagerLoading[] = $relation;
        return $this;
    }

    public function get(): array
    {
        if(isset($this->toUpdate)){
            if(is_array($this->toUpdate)){
                if(count($this->toUpdate) > 0){
                    $sql = $this->grammar()->update($this->table, $this->toUpdate, $this->wheres, $this->orWheres);
                    $this->executeAll($sql, array_values(array_merge($this->toUpdate, $this->wheres, $this->orWheres)));
                }
            }
        }

        $sql = $this->grammar()->select($this->table, $this->selects(), $this->count, $this->avg, $this->sum, $this->min, $this->max, $this->joins, $this->wheres, $this->orWheres, $this->groups, $this->havings, $this->orHavings, $this->orders, $this->offset, $this->limit);
        $rows = $this->executeAll($sql, $this->bindings());

        if(isset($this->toDelete)){
            if($this->toDelete){
                $sql = $this->grammar()->delete($this->table, $this->wheres, $this->orWheres);
                $this->executeAll($sql, array_values(array_merge($this->wheres, $this->orWheres)));
            }
        }

        $models = array_map(fn($r) => new $this->model($r), $rows);

        foreach($models as $model){
            if(count($this->eagerLoading) > 0){
                foreach($this->eagerLoading as $relation){
                    if(!isset($model->relationships[$relation])){
                        $model->relationships[$relation] = $model->$relation()->get();
                    }
                }
            }
        }

        return $models;
    }

    public function save(Model $model): void
    {
        $data = $model->attributes;

        if (isset($data['id'])) {
            $sql = $this->grammar()->update($this->table, $data, ['id' => $data['id']]);
        } else {
            $sql = $this->grammar()->insert($this->table, $data);
        }

        $this->execute($sql, array_values($data));
    }

    public function update(array $data): static{
        $this->toUpdate = array_merge($this->toUpdate, $data);
        return $this;
    }

    public function delete(): static{
        $this->toDelete = true;
        return $this;
    }

    public function join(string $table, string $first, string $operator, string $second): static{
        $this->joins[] = ["INNER", $table, $first, $operator, $second];
        return $this;
    }

    public function leftJoin(string $table, string $first, string $operator, string $second): static{
        $this->joins[] = ["LEFT", $table, $first, $operator, $second];
        return $this;
    }

    public function rightJoin(string $table, string $first, string $operator, string $second): static{
        $this->joins[] = ["RIGHT", $table, $first, $operator, $second];
        return $this;
    }
}