<?php

namespace Foundations\DB\Migrations;

use Foundations\DB\Database;
use Foundations\DB\Grammars\PostgresGrammar;

abstract class Migration {
    abstract public function up();
    
    abstract public function down();

    protected function create(string $name, callable $callback) {
        $table = new Table();
        $callback($table);

        $sql = PostgresGrammar::createTableSQL($name, $table->get_collumns());

        $db = new Database();

        $db->query($sql);
    }

    protected function dropIfExists(string $name) {
        $sql = PostgresGrammar::dropTableIfExistsSQL($name);

        $db = new Database();

        $db->query($sql);
    }

    protected function drop(string $name) {
        $sql = PostgresGrammar::dropTableSQL($name);

        $db = new Database();

        $db->query($sql);
    }

    public static function getMigrations(): array {
        $sql = PostgresGrammar::compileTableExists('migrations');

        $db = new Database();

        $tableExisted = $db->query($sql);

        if($tableExisted->rowCount() == 0) {
            $table = new Table();
            $table->id();
            $table->string('name')->size(255);
            $table->timestampTz('created_at')->default("CURRENT_TIMESTAMP");

            $sql = PostgresGrammar::createTableSQL('migrations', $table->get_collumns());

            $db->query($sql);

            return [];
        }else{
            $sql = "SELECT * FROM migrations";

            $migrations = $db->query($sql);

            return $migrations->fetchAll();
        }
    }

    public static function add_migration(string $name) {
        $sql = "INSERT INTO migrations (name) VALUES (:name)";
        $db = new Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public static function drop_migration(string $name) {
        $sql = "DELETE FROM migrations WHERE name = :name";
        $db = new Database();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}