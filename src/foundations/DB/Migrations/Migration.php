<?php

namespace Foundations\DB\Migrations;

use Foundations\DB\Database;
use Foundations\DB\Grammars\PostgresGrammar;

abstract class Migration {
    abstract public function up(): void;
    
    abstract public function down(): void;

    protected function create(string $name, callable $callback): void {
        $table = new Table();
        $callback($table);

        $sql = PostgresGrammar::createTableSQL($name, $table->get_columns());

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function dropIfExists(string $name): void {
        $sql = PostgresGrammar::dropTableIfExistsSQL($name);

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function drop(string $name): void {
        $sql = PostgresGrammar::dropTableSQL($name);

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function addColumn(string $name, callable $callback): void {
        $table = new Table();

        $callback($table);

        $column = $table->get_columns()[0];

        $sql = PostgresGrammar::addColumnSQL($name, $column);

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function addColumns(string $name, callable $callback): void {
        $table = new Table();

        $callback($table);

        $sql = PostgresGrammar::addColumnsSQL($name, $table->get_columns());

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function dropColumn(string $table, string $name): void {
        $sql = PostgresGrammar::dropColumnSQL($table, $name);

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function dropColumns(string $table, array $name): void {
        $sql = PostgresGrammar::dropColumnsSQL($table, $name);

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function updateColumn(string $name, callable $callback): void {
        $table = new Table();

        $callback($table);

        $column = $table->get_columns()[0];

        $sql = PostgresGrammar::updateColumnSQL($name, $column);

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function updateColumns(string $name, callable $callback): void {
        $table = new Table();

        $callback($table);

        $sql = PostgresGrammar::updateColumnsSQL($name, $table->get_columns());

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function renameTable(string $old, string $new){
        $sql = PostgresGrammar::renameTableSQL($old, $new);

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function renameColumn(string $table, string $old, string $new){
        $sql = PostgresGrammar::renameColumnSQL($table, $old, $new);

        $db = new Database();

        $db->query($sql);

        $db = null;
    }

    protected function renameColumns(string $table, array $old, array $new){
        $sql = PostgresGrammar::renameColumnsSQL($table, $old, $new);

        $db = new Database();

        $db->beginTransaction();

        $db->exec($sql);

        $db->commit();

        $db = null;
    }

    public static function getColumnStructure(string $table, string $column): string {

        $sql = PostgresGrammar::compileColumnExists($table, $column);
        $db = new Database();
        $result = $db->query($sql);

        if($result->rowCount() == 0) {
            $db = null;
            return '';
        }

        $sql = PostgresGrammar::checkColumnPrimarySQL($table, $column);
        $result = $db->query($sql);

        $primary = true;
        if($result->rowCount() == 0) {
            $primary = false;
        }


        $sql = PostgresGrammar::getColumnSQL($table, $column);
        $stmt = $db->query($sql);
        $result = $stmt->fetch();

        $structure = "\$table->";

        switch($result["data_type"]) {
            case "integer":{
                $structure .= "integer('{$result["column_name"]}')->";
                break;
            }
            case "character varying":{
                $structure .= "string('{$result["column_name"]}')->";
                break;
            }
            case "double precision":{
                $structure .= "float('{$result["column_name"]}')->";
                break;
            }
            case "boolean":{
                $structure .= "boolean('{$result["column_name"]}')->";
                break;
            }
            case "date":{
                $structure .= "date('{$result["column_name"]}')->";
                break;
            }
            case "time without time zone":{
                $structure .= "time('{$result["column_name"]}')->";
                break;
            }
            case "timestamp without time zone":{
                $structure .= "timestamp('{$result["column_name"]}')->";
                break;
            }
            case "timestamp with time zone":{
                $structure .= "timestampTz('{$result["column_name"]}')->";
                break;
            }
            default: {
                $db = null;
                return '';
            }
        }

        if($result["is_identity"] == "YES") {
            if($primary) {
                return "\$table->id('{$result["column_name"]}');";
            }else{
                $structure .= "auto_increment()->";
            }
        }

        if($result["character_maximum_length"]) {
            $structure .= "size({$result["character_maximum_length"]})->";
        }

        if($result["is_nullable"] == "YES") {
            $structure .= "nullable()->";
        }

        if($result["column_default"]) {
            $default = $result["column_default"];
            if (preg_match("/^'(.*)'::/", $default, $matches)) {
                $default = $matches[1];
            }
            $structure .= "default('{$default}')->";
        }

        $sql = PostgresGrammar::checkColumnUniqueSQL($table, $column);
        $result = $db->query($sql);

        $unique = true;
        if($result->rowCount() == 0) {
            $unique = false;
        }

        if($unique) {
            $structure .= "unique()->";
        }

        if($primary){
            $structure .= "primary_key()->";
        }

        $db = null;
        
        $structure = substr($structure, 0, -2) . ";\n";

        return $structure;
    }

    public static function getMigrations(): array {
        $sql = PostgresGrammar::compileTableExists('migrations');

        $db = new Database();

        $tableExisted = $db->query($sql);

        if($tableExisted->rowCount() == 0) {
            $table = new Table();
            $table->id();
            $table->string('name')->size(255)->unique();
            $table->timestampTz('created_at')->default("CURRENT_TIMESTAMP");

            $sql = PostgresGrammar::createTableSQL('migrations', $table->get_columns());

            $db->query($sql);

            $db = null;

            return [];
        }else{
            $sql = PostgresGrammar::getMigrationsSQL();

            $migrations = $db->query($sql);

            $db = null;

            return $migrations->fetchAll();
        }
    }

    public static function add_migration(string $name): void {
        $sql = PostgresGrammar::addMigrationSQL($name);
        $db = new Database();
        $db->query($sql);
        $db = null;
    }

    public static function drop_migration(string $name): void {
        $sql = PostgresGrammar::dropMigrationSQL($name);
        $db = new Database();
        $db->query($sql);
        $db = null;
    }
}