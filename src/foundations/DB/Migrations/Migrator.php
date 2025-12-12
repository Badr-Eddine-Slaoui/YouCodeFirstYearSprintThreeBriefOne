<?php

namespace Foundations\DB\Migrations;

define("MIGRATION_DIR", __DIR__ ."/../../../database/Migrations/");

class Migrator {
    public static function getMigratedMigrations(): array {
        return Migration::getMigrations();
    }

    public static function getColumnStructure(string $table, string $column): string {
        return Migration::getColumnStructure($table, $column);
    }

    public static function migrate(): void {
        $migrations = glob(MIGRATION_DIR . "*.php");

        if(\count($migrations) === 0) {
            echo "No migrations found.\n";
            return;
        }

        $migrations = \array_map(fn($migration) => \str_replace(".php","", \basename($migration)), $migrations);
        
        $migrated_migrations = \array_column(self::getMigratedMigrations(), 'name');

        $to_migrate_migrations = \array_filter($migrations, fn($migration) => !\in_array($migration, $migrated_migrations));

        if(\count($to_migrate_migrations) === 0) {
            echo "No migrations to migrate.\n";
            return;
        }

        echo "Migration start...\n\n";

        $global_start_time = \microtime(true);

        foreach ($to_migrate_migrations as $migration) {

            $start_time = \microtime(true);

            echo "Running migration: $migration...\n\n";

            $instance = require MIGRATION_DIR . "$migration.php";
            $instance->up();

            Migration::add_migration($migration);

            echo "Migration $migration completed in ". \round(\microtime(true) - $start_time, 2) ."s\n\n";
        }

        echo "Migrations completed in ". \round(\microtime(true) - $global_start_time, 2) ."s\n\n";
    }

    public static function down(): void {
        $migrations = array_reverse(glob(MIGRATION_DIR . "*.php"));

        if(\count($migrations) === 0) {
            echo "No migrations found.\n";
            return;
        }

        $migrations = \array_map(fn($migration) => \str_replace(".php","", \basename($migration)), $migrations);
        
        $migrated_migrations = \array_reverse(\array_column(self::getMigratedMigrations(), 'name'));

        $to_rollback_migrations = \array_filter($migrations, fn($migration) => \in_array($migration, $migrated_migrations));


        if(\count($to_rollback_migrations) === 0) {
            echo "No migrations to rollback.\n";
            return;
        }

        echo "Rollback start...\n\n";

        $global_start_time = \microtime(true);

        foreach ($to_rollback_migrations as $migration) {

            $start_time = \microtime(true);

            echo "Rolling back migration: $migration...\n\n";

            $instance = require MIGRATION_DIR . "$migration.php";
            $instance->down();

            Migration::drop_migration($migration);

            echo "Rollback migration $migration completed in ". \round(\microtime(true) - $start_time, 2) ."s\n\n";
        }

        echo "Rollback completed in ". \round(\microtime(true) - $global_start_time, 2) ."s\n\n";
    }

    public static function rollback(): void {
        
        $migrations = array_reverse(glob(MIGRATION_DIR . "*.php"));

        if(\count($migrations) === 0) {
            echo "No migrations found.\n";
            return;
        }

        $migrations = \array_map(fn($migration) => \str_replace(".php","", \basename($migration)), $migrations);
        
        $migrated_migrations = \array_reverse(\array_column(self::getMigratedMigrations(), 'name'));

        $to_rollback_migrations = \array_values(\array_filter($migrations, fn($migration) => \in_array($migration, $migrated_migrations)));

        if(\count($to_rollback_migrations) === 0) {
            echo "No migration to rollback.\n";
            return;
        }

        $migration = $to_rollback_migrations[0];

        $start_time = \microtime(true);

        echo "Rolling back migration: $migration...\n\n";

        $instance = require_once MIGRATION_DIR . "$migration.php";
        $instance->down();

        Migration::drop_migration($migration);

        echo "Rollback migration $migration completed in ". \round(\microtime(true) - $start_time, 2) ."s\n\n";
    }
}