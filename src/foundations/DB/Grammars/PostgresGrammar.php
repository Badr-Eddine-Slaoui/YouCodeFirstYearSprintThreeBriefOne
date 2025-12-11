<?php

namespace Foundations\DB\Grammars;

use Foundations\DB\Migrations\Column;

class PostgresGrammar extends Grammar{
    public static function compileTableExists(string $table) {
        return "SELECT * FROM information_schema.tables WHERE table_name = '$table'";
    }

    public static function compileColumnExists(string $table, string $column) {
        return "SELECT * FROM information_schema.columns WHERE table_name = '$table' AND column_name = '$column'";
    }

    public static function createTableSQL(string $table, array $columns) {
        $sql = self::compileColumns($columns);
        return "CREATE TABLE IF NOT EXISTS $table ($sql);";
    }

    public static function compileColumns(array $columns) {
        $sql = "";
        foreach($columns as $column) {
            $sql .= self::columnToSQL($column);
        }
        $sql = \substr($sql, 0, -1);
        return $sql;
    }

    public static function columnToSQL(Column $column) {
        $column = $column->column;

        $name = $type = $size = $default = $nullable = $unique = $auto_increment = $primary_key = null;

        if(isset($column["name"])) {
            $name = $column["name"];
        }

        if(isset($column["type"])) {
            if($column["type"] == "string") {
                if(!isset($column["size"])) {
                    $column["size"] = 255;
                }
                $type = "varchar(" . $column["size"] . ")";
            }else{
                $type = $column["type"];
            }
        }

        if(isset($column["default"])) {
            $default = "DEFAULT " . $column["default"];
        }

        if(isset($column["unique"])) {
            $unique = "UNIQUE";
        }

        if(isset($column["auto_increment"])) {
            $auto_increment = "GENERATED ALWAYS AS IDENTITY";
        }

        if(isset($column["primary_key"])) {
            $primary_key = "PRIMARY KEY";
        }

        if(isset($column["nullable"])) {
            $nullable = $column["nullable"] ? "" : "NOT NULL";
        }else{
            $nullable = "NOT NULL";
        }
        
        return "$name $type $size $default $nullable $unique $auto_increment $primary_key,";
    }

    public static function dropTableSQL(string $table) {
        return "DROP TABLE $table;";
    }

    public static function dropTableIfExistsSQL(string $table) {
        return "DROP TABLE IF EXISTS $table;";
    }
}