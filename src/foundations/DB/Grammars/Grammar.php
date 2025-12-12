<?php

namespace Foundations\DB\Grammars;

use Foundations\DB\Migrations\Column;

abstract class Grammar {
    abstract public static function compileTableExists(string $table);

    abstract public static function compileColumnExists(string $table, string $column);

    abstract public static function createTableSQL(string $table, array $columns);

    abstract public static function compileColumns(array $columns);

    abstract public static function columnToSQL(Column $column);

    abstract public static function dropTableSQL(string $table);

    abstract public static function dropTableIfExistsSQL(string $table);

    abstract public static function getMigrationsSQL();

    abstract public static function addMigrationSQL(string $name);

    abstract public static function dropMigrationSQL(string $name);
}