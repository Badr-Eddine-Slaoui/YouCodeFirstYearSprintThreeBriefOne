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
            $default = $column["type"] == "string" ? "DEFAULT '{$column["default"]}'" : "DEFAULT {$column["default"]}";
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

    public static function columnToUpdateSQL(string $table, Column $column) {
        $column = $column->column;

        $name = $type = $size = $default = $nullable = $unique = $auto_increment = $primary_key = null;

        if(isset($column["name"])) {
            $name = $column["name"];
        }

        $alter_str = "ALTER COLUMN $name";

        if(isset($column["type"])) {
            if($column["type"] == "string") {
                if(!isset($column["size"])) {
                    $column["size"] = 255;
                }
                $type = "$alter_str TYPE varchar(" . $column["size"] . "),";
            }else{
                $type = "$alter_str TYPE {$column["type"]},";
            }
        }

        if(isset($column["default"])) {
            $default = $column["type"] == "string" ? "DEFAULT '{$column["default"]}'" : "DEFAULT {$column["default"]}";
            $default = "$alter_str SET $default,";
        }

        if(isset($column["unique"])) {
            $unique = "IF NOT EXISTS (
                            SELECT 1 
                            FROM information_schema.table_constraints
                            WHERE table_name='{$table}' 
                            AND constraint_type='UNIQUE'
                        ) THEN
                            EXECUTE 'ALTER TABLE {$table} ADD CONSTRAINT {$table}_{$name}_key UNIQUE ({$name})';
                        END IF;";
        }

        if(isset($column["auto_increment"])) {
            $auto_increment = "$alter_str ADD GENERATED ALWAYS AS IDENTITY,";
        }

        if(isset($column["primary_key"])) {
            $primary_key = "IF NOT EXISTS (
                                SELECT 1 
                                FROM information_schema.table_constraints
                                WHERE table_name='{$table}' 
                                AND constraint_type='PRIMARY KEY'
                            ) THEN
                                EXECUTE 'ALTER TABLE {$table} ADD CONSTRAINT {$table}_pkey PRIMARY KEY ({$name})';
                            END IF;";
        }

        if(isset($column["nullable"])) {
            $nullable = $column["nullable"] ? "" : "$alter_str SET NOT NULL,";
        }else{
            $nullable = "$alter_str SET NOT NULL,";
        }

        $sql = substr(trim("$type $size $default $nullable $auto_increment"), 0, -1) . ";";
        
        return "$sql\n $unique\n $primary_key";
    }

    public static function addColumnSQL(string $table, Column $column) {
        $sql = self::columnToSQL($column);
        $sql = str_replace(",","", $sql);
        return "DO $$
                BEGIN
                    IF NOT EXISTS (
                        SELECT 1 FROM information_schema.columns 
                        WHERE table_name = '$table' 
                        AND column_name = '{$column->getName()}'
                    ) THEN
                        ALTER TABLE $table ADD COLUMN $sql;
                    END IF;
                END $$;";
    }

    public static function addColumnsSQL(string $table, array $columns) {
        $result = "DO $$
                    BEGIN";
        foreach($columns as $column) {
            $sql = self::columnToSQL($column);
            $sql = str_replace(",","", $sql);
            $result .= "
                        IF NOT EXISTS (
                            SELECT 1 FROM information_schema.columns 
                            WHERE table_name = '$table' 
                            AND column_name = '{$column->getName()}'
                        ) THEN
                            ALTER TABLE $table ADD COLUMN $sql;
                        END IF;
                    ";
        }
        return "$result END $$;";
    }

    public static function dropColumnSQL(string $table, string $column) {
        return "ALTER TABLE IF EXISTS $table DROP COLUMN IF EXISTS $column;";
    }

    public static function dropColumnsSQL(string $table, array $columns) {
        $sql = "ALTER TABLE IF EXISTS $table ";
        foreach($columns as $column) {
            $sql .= "DROP COLUMN IF EXISTS $column,";
        }
        return substr($sql, 0, -1) . ";";
    }

    public static function updateColumnSQL(string $table, Column $column) {
        $sql = self::columnToUpdateSQL($table, $column);
        
        return "DO $$
                BEGIN
                    IF EXISTS (
                        SELECT 1 FROM information_schema.columns
                        WHERE table_name = '$table'
                        AND column_name = '{$column->getName()}'
                    ) THEN
                        ALTER TABLE $table
                        $sql
                    END IF;
                END $$;";
    }

    public static function updateColumnsSQL(string $table, array $columns) {
        $result = "DO $$
                    BEGIN";
        foreach($columns as $column) {
            $sql = self::columnToUpdateSQL($table, $column);
            
            $result .= "
                        IF EXISTS (
                            SELECT 1 FROM information_schema.columns
                            WHERE table_name = '$table'
                            AND column_name = '{$column->getName()}'
                        ) THEN
                            ALTER TABLE $table
                            $sql
                        END IF;
                    ";
        }
        return "$result END $$;";
    }

    public static function getColumnSQL(string $table, string $column) {
        return "SELECT 
                    column_name,
                    data_type,
                    character_maximum_length,
                    column_default,
                    is_nullable,
                    is_identity, 
                    identity_generation
                FROM information_schema.columns
                WHERE table_name = '$table'
                AND column_name = '$column';";
    }

    public static function checkColumnUniqueSQL(string $table, string $column){
        return "SELECT tc.constraint_name
                FROM information_schema.table_constraints tc
                JOIN information_schema.constraint_column_usage ccu 
                    ON tc.constraint_name = ccu.constraint_name
                WHERE tc.table_name = '$table'
                AND tc.constraint_type = 'UNIQUE'
                AND ccu.column_name = '$column';
                ";
    }

    public static function checkColumnPrimarySQL(string $table, string $column){
        return "SELECT tc.constraint_name
                FROM information_schema.table_constraints tc
                JOIN information_schema.constraint_column_usage ccu 
                    ON tc.constraint_name = ccu.constraint_name
                WHERE tc.table_name = '$table'
                AND tc.constraint_type = 'PRIMARY KEY'
                AND ccu.column_name = '$column';
                ";
    }

    public static function dropTableSQL(string $table) {
        return "DROP TABLE $table;";
    }

    public static function dropTableIfExistsSQL(string $table) {
        return "DROP TABLE IF EXISTS $table;";
    }

    public static function getMigrationsSQL(): string {
        return "SELECT * FROM migrations";
    }

    public static function addMigrationSQL(string $name): string {
        return "INSERT INTO migrations (name) VALUES ('$name')";
    }

    public static function dropMigrationSQL(string $name): string {
        return "DELETE FROM migrations WHERE name = '$name'";
    }
}