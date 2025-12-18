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
}