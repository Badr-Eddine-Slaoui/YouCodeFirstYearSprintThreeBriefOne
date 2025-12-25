<?php

namespace Foundations\DB\Grammars;

use Foundations\DB\Migrations\Column;

class PostgresGrammar extends Grammar{
    public function select(string $table, array $columns, array $counts = [], array $avg = [], array $sum = [], array $min = [], array $max = [], array $joins = [], array $wheres = [], array $orWheres = [], array $groups = [], array $havings = [], array $orHavings = [], array $orders = [], ?int $offset = null, ?int $limit = null): string
    {
        $selects = "";

        if(count($columns) > 0){
            foreach ($columns as $key => $value) {
                if (!isset($value)) {
                    $selects .= "{$key}, ";
                } else {
                    $selects .= "{$key} AS {$value}, ";
                }
            }
        }

        $countsColumns = "";

        if(count($counts) > 0){
            foreach ($counts as $key => $value) {
                if (!isset($value)) {
                    $countsColumns .= "COUNT({$key}), ";
                } else {
                    $countsColumns .= "COUNT({$key}) AS {$value}, ";
                }
            }
        }

        $avgColumns = "";

        if(count($avg) > 0){
            foreach ($avg as $key => $value) {
                if (!isset($value)) {
                    $avgColumns .= "AVG({$key}), ";
                } else {
                    $avgColumns .= "AVG({$key}) AS {$value}, ";
                }
            }
        }

        $sumColumns = "";

        if(count($sum) > 0){
            foreach ($sum as $key => $value) {
                if (!isset($value)) {
                    $sumColumns .= "SUM({$key}), ";
                } else {
                    $sumColumns .= "SUM({$key}) AS {$value}, ";
                }
            }
        }

        $minColumns = "";

        if(count($min) > 0) {
            foreach ($min as $key => $value) {
                if (!isset($value)) {
                    $minColumns .= "MIN({$key}), ";
                } else {
                    $minColumns .= "MIN({$key}) AS {$value}, ";
                }
            }
        }

        $maxColumns = "";

        if(count($max) > 0) {
            foreach ($max as $key => $value) {
                if (!isset($value)) {
                    $maxColumns .= "MAX({$key}), ";
                } else {
                    $maxColumns .= "MAX({$key}) AS {$value}, ";
                }
            }
        }

        $allcolumns = $selects . $countsColumns . $avgColumns . $sumColumns . $minColumns . $maxColumns;

        $sql = 'SELECT ' . rtrim($allcolumns, ', ') . " FROM {$table}";

        $joinsStr = "";

        if(count($joins) > 0) {
            foreach ($joins as $join) {
                $joinsStr .= " {$join[0]} JOIN {$join[1]} ON {$join[2]} {$join[3]} {$join[4]}";
            }
        }

        $sql .= $joinsStr;

        if (count($wheres) > 0) {
            foreach ($wheres as $column => $where) {
                if (str_contains($sql,"WHERE")) {
                    $sql .= " AND {$column} {$where[0]} ?";
                } else {
                    $sql .= " WHERE {$column} {$where[0]} ?";
                }
            }
        }

        if (count($orWheres) > 0) {
            foreach ($orWheres as $column => $where) {
                if (str_contains($sql,"WHERE")) {
                    $sql .= " OR {$column} {$where[0]} ?";
                } else {
                    $sql .= " WHERE {$column} {$where[0]} ?";
                }
            }
        }

        $groupsStr = "";

        if (count($groups) > 0) {
            $groupsStr .= " GROUP BY ";
            foreach ($groups as $column => $_) {
                $groupsStr .= " {$column}, ";
            }
        }

        $sql .= rtrim($groupsStr, ", ");

        if (count($havings) > 0) {
            foreach ($havings as $column => $having) {
                if (str_contains($sql,"HAVING")) {
                    $sql .= " AND {$column} {$having[0]} ?";
                } else {
                    $sql .= " HAVING {$column} {$having[0]} ?";
                }
            }
        }

        if (count($orHavings) > 0) {
            foreach ($orHavings as $column => $having) {
                if (str_contains($sql,"HAVING")) {
                    $sql .= " OR {$column} {$having[0]} ?";
                } else {
                    $sql .= " HAVING {$column} {$having[0]} ?";
                }
            }
        }

        $ordersStr = "";

        if (count($orders) > 0) {
            $ordersStr .= " ORDER BY ";
            foreach ($orders as $column => $order) {
                $ordersStr .= " {$column} {$order}, ";
            }
        }

        $sql .= rtrim($ordersStr, ", ");

        if ($offset) {
            $sql .= " OFFSET ?";
        }

        if ($limit) {
            $sql .= " LIMIT ?";
        }

        return "$sql;";
    }

    public function insert(string $table, array $data): string
    {
        $columns = implode(', ', array_keys($data));
        $values  = implode(', ', array_fill(0, count($data), '?'));

        return "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
    }

    public function update(string $table, array $data, array $wheres = [], array $orWheres = []): string
    {
        $sql = "UPDATE {$table} SET ";

        $set = implode(', ', array_map(
            fn($col) => "{$col} = ?",
            array_keys($data)
        ));

        $sql .= $set;

        if (count($wheres) > 0) {
            $conditions = implode(' AND ', array_map(
                fn($col) => "{$col} = ?",
                array_keys($wheres)
            ));
            
            if (str_contains($sql,"WHERE")) {
                $sql .= " AND {$conditions}";
            } else {
                $sql .= " WHERE {$conditions}";
            }
        }

        if (count($orWheres) > 0) {
            $conditions = implode(' OR ', array_map(
                fn($col) => "{$col} = ?",
                array_keys($orWheres)
            ));

            if(str_contains($sql,"WHERE")) {
                $sql .= " OR {$conditions}";
            } else {
                $sql .= " WHERE {$conditions}";
            }
        }

        return $sql;
    }

    public function delete(string $table, array $wheres = [], array $orWheres = []): string{
        $sql = "DELETE FROM {$table} ";

        if (count($wheres) > 0) {
            $conditions = implode(' AND ', array_map(
                fn($col) => "{$col} = ?",
                array_keys($wheres)
            ));
            
            if (str_contains($sql,"WHERE")) {
                $sql .= " AND {$conditions}";
            } else {
                $sql .= " WHERE {$conditions}";
            }
        }

        if (count($orWheres) > 0) {
            $conditions = implode(' OR ', array_map(
                fn($col) => "{$col} = ?",
                array_keys($orWheres)
            ));

            if(str_contains($sql,"WHERE")) {
                $sql .= " OR {$conditions}";
            } else {
                $sql .= " WHERE {$conditions}";
            }
        }

        return $sql;

    }

    public static function compileTableExists(string $table): string {
        return "SELECT * FROM information_schema.tables WHERE table_name = '$table'";
    }

    public static function compileColumnExists(string $table, string $column): string {
        return "SELECT * FROM information_schema.columns WHERE table_name = '$table' AND column_name = '$column'";
    }

    public static function createTableSQL(string $table, array $columns): string {
        $sql = self::compileColumns($columns);
        return "CREATE TABLE IF NOT EXISTS $table ($sql);";
    }

    public static function compileColumns(array $columns): string {
        $sql = "";
        foreach($columns as $column) {
            $sql .= self::columnToSQL($column);
        }
        $sql = \substr($sql, 0, -1);
        return $sql;
    }

    public static function columnToSQL(Column $column): string {
        $column = $column->column;

        $name = $type = $size = $default = $nullable = $unique = $auto_increment = $primary_key = $references = $onDelete = $onUpdate = null;

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

        if(isset($column["references"])) {
            $references = "REFERENCES {$column["references"]["table"]}({$column["references"]["column"]})";
        }

        if(isset($column["onDelete"])) {
            $onDelete = "ON DELETE {$column["onDelete"]}";
        }

        if(isset($column["onUpdate"])) {
            $onUpdate = "ON UPDATE {$column["onUpdate"]}";
        }

        if(isset($column["nullable"])) {
            $nullable = $column["nullable"] ? "" : "NOT NULL";
        }else{
            $nullable = "NOT NULL";
        }

        if(str_contains($type,"FOREIGN KEY")) {
            $name = $default = $nullable = $unique = $auto_increment = $primary_key = null;
        }
        
        return "$name $type $size $default $nullable $unique $auto_increment $primary_key $references $onDelete $onUpdate,";
    }

    public static function columnToUpdateSQL(string $table, Column $column): string {
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

    public static function addColumnSQL(string $table, Column $column): string {
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

    public static function addColumnsSQL(string $table, array $columns): string {
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

    public static function dropColumnSQL(string $table, string $column): string {
        return "ALTER TABLE IF EXISTS $table DROP COLUMN IF EXISTS $column;";
    }

    public static function dropColumnsSQL(string $table, array $columns): string {
        $sql = "ALTER TABLE IF EXISTS $table ";
        foreach($columns as $column) {
            $sql .= "DROP COLUMN IF EXISTS $column,";
        }
        return substr($sql, 0, -1) . ";";
    }

    public static function updateColumnSQL(string $table, Column $column): string {
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

    public static function updateColumnsSQL(string $table, array $columns): string {
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

    public static function getColumnSQL(string $table, string $column): string {
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

    public static function checkColumnUniqueSQL(string $table, string $column): string{
        return "SELECT tc.constraint_name
                FROM information_schema.table_constraints tc
                JOIN information_schema.constraint_column_usage ccu 
                    ON tc.constraint_name = ccu.constraint_name
                WHERE tc.table_name = '$table'
                AND tc.constraint_type = 'UNIQUE'
                AND ccu.column_name = '$column';
                ";
    }

    public static function checkColumnPrimarySQL(string $table, string $column): string{
        return "SELECT tc.constraint_name
                FROM information_schema.table_constraints tc
                JOIN information_schema.constraint_column_usage ccu 
                    ON tc.constraint_name = ccu.constraint_name
                WHERE tc.table_name = '$table'
                AND tc.constraint_type = 'PRIMARY KEY'
                AND ccu.column_name = '$column';
                ";
    }

    public static function dropTableSQL(string $table): string {
        return "DROP TABLE $table;";
    }

    public static function dropTableIfExistsSQL(string $table): string {
        return "DROP TABLE IF EXISTS $table;";
    }

    public static function renameTableSQL(string $old, string $new): string
    {
        return "ALTER TABLE $old RENAME TO $new;";
    }

    public static function renameColumnSQL(string $table, string $old, string $new): string
    {
        return "ALTER TABLE $table RENAME COLUMN $old TO $new;";
    }

    public static function renameColumnsSQL(string $table, array $old, array $new): string
    {
        $sql = "";

        foreach($old as $key => $column) {
            $sql .= "ALTER TABLE $table RENAME COLUMN $column TO $new[$key];";
        }

        return $sql;
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