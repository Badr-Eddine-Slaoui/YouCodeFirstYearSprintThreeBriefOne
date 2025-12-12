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

        $sql = PostgresGrammar::createTableSQL($name, $table->get_collumns());

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

    public static function getMigrations(): array {
        $sql = PostgresGrammar::compileTableExists('migrations');

        $db = new Database();

        $tableExisted = $db->query($sql);

        if($tableExisted->rowCount() == 0) {
            $table = new Table();
            $table->id();
            $table->string('name')->size(255)->unique();
            $table->timestampTz('created_at')->default("CURRENT_TIMESTAMP");

            $sql = PostgresGrammar::createTableSQL('migrations', $table->get_collumns());

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