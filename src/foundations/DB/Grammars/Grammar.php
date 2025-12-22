<?php

namespace Foundations\DB\Grammars;

use Foundations\DB\Migrations\Column;

abstract class Grammar {
    abstract public function select(string $table, array $columns, array $counts = [], array $avg = [], array $sum = [], array $min = [], array $max = [], array $joins = [], array $wheres = [], array $orWheres = [], array $groups = [], array $havings = [], array $orHavings = [], array $orders = [], ?int $offset = null, ?int $limit = null): string;

    abstract public function insert(string $table, array $data): string;

    abstract public function update(string $table, array $data, array $wheres = [], array $orWheres = []): string;

    abstract public function delete(string $table, array $wheres = [], array $orWheres = []): string;

    abstract public static function compileTableExists(string $table): string;

    abstract public static function compileColumnExists(string $table, string $column): string;

    abstract public static function createTableSQL(string $table, array $columns): string;

    abstract public static function compileColumns(array $columns): string;

    abstract public static function columnToSQL(Column $column): string;

    abstract public static function columnToUpdateSQL(string $table, Column $column): string;

    abstract public static function addColumnSQL(string $table, Column $column): string;

    abstract public static function addColumnsSQL(string $table, array $columns): string;

    abstract public static function dropColumnSQL(string $table, string $column): string;

    abstract public static function dropColumnsSQL(string $table, array $columns): string;

    abstract public static function updateColumnSQL(string $table, Column $column): string;

    abstract public static function updateColumnsSQL(string $table, array $columns): string;

    abstract public static function getColumnSQL(string $table, string $column): string;

    abstract public static function checkColumnUniqueSQL(string $table, string $column): string;

    abstract public static function checkColumnPrimarySQL(string $table, string $column): string;

    abstract public static function dropTableSQL(string $table): string;

    abstract public static function dropTableIfExistsSQL(string $table): string;

    abstract public static function renameTableSQL(string $old, string $new): string;

    abstract public static function renameColumnSQL(string $table, string $old, string $new): string;

    abstract public static function renameColumnsSQL(string $table, array $old, array $new): string;

    abstract public static function getMigrationsSQL(): string;

    abstract public static function addMigrationSQL(string $name): string;

    abstract public static function dropMigrationSQL(string $name): string;
}