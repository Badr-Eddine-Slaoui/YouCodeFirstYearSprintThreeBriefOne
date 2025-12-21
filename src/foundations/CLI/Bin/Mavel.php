<?php

namespace Foundations\CLI\Bin;

use Foundations\DB\Migrations\Migrator;

define('ROOT_DIR', __DIR__ .'/../../..');
define('APP_DIR', __DIR__ .'/../../../app');
define('DATABASE_DIR', __DIR__ .'/../../../database');

class Mavel {
    private $argv = [];
    private $command;
    private $options = [];

    public function __construct() {
        $a = $_SERVER['argv'];

        foreach($a as $arg) {
            if (\str_starts_with($arg,'-')) {
                if ($arg === '-r') {
                    $this->options['r'] = true;
                }
                if ($arg === '--resource') {
                    $this->options['resource'] = true;
                }
                if ($arg === '-c') {
                    $this->options['c'] = true;
                }
                if ($arg === '--controller') {
                    $this->options['controller'] = true;
                }
                continue;
            }
            $this->argv[] = $arg;
        }


        \array_shift($this->argv);

        if (\count($this->argv) === 0) {
            echo "No command provided. Use 'mavel help' for help.\n";
            exit(1);
        }

        $this->command = $this->argv[0];
    }

    public function run(): void {
        switch ($this->command) {
            case 'help':{
                $this->displayHelpMenue();
                break;
            }
            case 'build/controller':{

                $name = $this->getName("controller");

                $optR = isset($this->options['r']) || isset($this->options['resource']);

                $this->validateName($name, 'controller');

                if ($optR) {
                    $this->buildFile($name, "ResourceController");
                } else {
                    $this->buildFile($name,"Controller");
                }

                break;
            }
            case 'build/model':{
                $name = $this->getName("Model");

                $optC = isset($this->options['c']) || isset($this->options['controller']);
                $optR = isset($this->options['r']) || isset($this->options['resource']);

                $this->validateName($name, 'Model');

                if ($optC) {
                    $name = "{$name}Controller";
                    if ($optR) {
                        $this->buildFile($name, "ResourceController");
                    } else {
                        $this->buildFile($name,"Controller");
                    }
                    $name = str_replace("Controller", "", $name);
                }

                $name = str_replace("Model", "", $name);

                $this->buildModel($name);

                break;
            }
            case "build/migration":{
                $name = $this->getName("migration");

                $this->validateMigrationName($name);

                $date = date("Y_m_d_His");

                if(str_contains($name,"create")) {
                    $this->buildMigration($name, $date);
                    break;
                }
                
                if(str_contains($name,"add_column")) {
                    $this->buildAddColumnMigration($name, $date);
                    break;
                }

                if(str_contains($name,"remove_column")) {
                    $this->buildDropColumnMigration($name, $date);
                    break;
                }

                if(str_contains($name,"update_column")) {
                    $this->buildUpdateColumnMigration($name, $date);
                    break;
                }

                if(str_contains($name,"rename_table")) {
                    $this->buildRenameTableMigration($name, $date);
                    break;
                }

                if(str_contains($name,"rename_column")) {
                    $this->buildRenameColumnMigration($name, $date);
                    break;
                }

                break;
            }
            case "migrate":{
                Migrator::migrate();
                break;
            }
            case "migrate/down":{
                Migrator::down();
                break;
            }
            case "migrate/rollback":{
                Migrator::rollback();
                break;
            }
            case "migrate/refresh":{
                $start_time = \microtime(true);

                Migrator::down();
                Migrator::migrate();

                echo "Migrations refreshed in " . \round(\microtime(true) - $start_time,2) . "s\n\n";
                break;
            }
            default:
                echo "Command '$this->command' not found. Use 'mavel help' for help.\n";
                exit(1);
        }
    }

    private function getName(string $postfix): string | null {

        $postfix = \ucfirst($postfix);

        if(\count($this->argv) === 1) {
            echo "Please provide a $postfix name.\n";
            exit(1);
        }

        return $this->argv[1];
    }

    private function validateName(string &$name, string $postfix): void {

        $postfix = \ucfirst($postfix);

        if(!\preg_match('/^[a-zA-Z]+$/', $name)) {
            echo "Invalid $postfix name.\n";
            exit(1);
        }
        
        $name = \ucfirst($name);

        if (!\strpos($name, $postfix) && $postfix != "Model") {
            $name .= $postfix;
        }
    }

    private function validateMigrationName(string $name): void {
        $sc = "(?!and$)(?!and_)[a-z]+(?:_(?!and$)(?!and_)[a-z]+)*";

        if(
            !preg_match("/^create_{$sc}_table$/", $name) &&
            !preg_match("/^add_column_{$sc}_to_{$sc}_table$/", $name) &&
            !preg_match("/^add_columns_{$sc}(?:_and_{$sc})*_to_{$sc}_table$/", $name) &&
            !preg_match("/^remove_column_{$sc}_from_{$sc}_table$/", $name) &&
            !preg_match("/^remove_columns_{$sc}(?:_and_{$sc})*_from_{$sc}_table$/", $name)&&
            !preg_match("/^update_column_{$sc}_from_{$sc}_table$/", $name) &&
            !preg_match("/^update_columns_{$sc}(?:_and_{$sc})*_from_{$sc}_table$/", $name) &&
            !preg_match("/^rename_table_{$sc}_to_{$sc}$/", $name) &&
            !preg_match("/^rename_column_{$sc}_from_{$sc}_table$/", $name) &&
            !preg_match("/^rename_columns_{$sc}(?:_and_{$sc})*_from_{$sc}_table$/", $name)
        ){
            echo "Migration name must be in this formats:\n    -'create_name_table'\n    -'add_column_name_to_name_table'\n    -'add_columns_name_and_name_to_name_table'\n    -'remove_column_name_from_name_table'\n    -'remove_columns_name_and_name_from_name_table'\n    -'update_column_name_from_name_table'\n    -'update_columns_name_and_name_from_name_table'\n    -'rename_table_name_to_name'\n    -'rename_column_name_from_name_table'\n    -'rename_columns_name_and_name_from_name_table'\nNote: name can only contain lowecase letters and underscores.\n";
            exit(1);
        }
    }

    private function displayHelpMenue(): void {
        echo "Usage: mavel <command> <name>\n";
        echo "Commands:\n";
        echo "  help\n";
        echo "  build/controller\n";
        echo "      OPTIONS:\n";
        echo "          -r, --resource\n";
    }

    private function buildFile(string $name, string $postfix): void {

        $postfix = \ucfirst($postfix);

        $dirs = [
            "Controller" => [
                "template"=> __DIR__ . '/../templates/Controller.php',
                "dir" => APP_DIR . '/Controllers',
                "filePath" => "./app/Controllers/$name.php",
                "name" => $name
            ],
            "ResourceController" => [
                "template"=> __DIR__ . '/../templates/ResourceController.php',
                "dir" => APP_DIR . '/Controllers',
                "filePath" => "./app/Controllers/$name.php",
                "name"=> $name
            ]
        ];

        $dir = $dirs[$postfix]['dir'];

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $file = "$dir/$name.php";
        $filePath = $dirs[$postfix]["filePath"];
        
        if (\file_exists($file)) {
            echo "$postfix already exists: $filePath\n";
            return;
        }

        $content = \file_get_contents($dirs[$postfix]["template"]);

        $content = \str_replace("{$postfix}Template", $dirs[$postfix]["name"], $content);

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "$postfix created: $filePath\n";
    }

    private function buildModel(string $name): void {

        $template =  __DIR__ . '/../templates/Model.php';
        $dir = APP_DIR . '/Models';
        $filePath = "./app/Models/$name.php";

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $file = "$dir/$name.php";
        
        if (\file_exists($file)) {
            echo "Model already exists: $filePath\n";
            return;
        }

        $content = \file_get_contents($template);

        $content = \str_replace("ModelName", $name, $content);

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "Model created: $filePath\n";
    }

    private function buildMiddleware(string $name): void {

        $template =  __DIR__ . '/../templates/Middleware.php';
        $dir = APP_DIR . '/Middlewares';
        $filePath = "./app/Middlewares/$name.php";

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $file = "$dir/$name.php";
        
        if (\file_exists($file)) {
            echo "Middleware already exists: $filePath\n";
            return;
        }

        $content = \file_get_contents($template);

        $content = \str_replace("MiddlewareName", $name, $content);

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "Middleware created: $filePath\n";
    }

    private function buildMigration(string $name, string $date): void {

        $template =  __DIR__ . '/../templates/Migration.php';
        $dir = DATABASE_DIR . '/Migrations';
        $filePath = "./database/Migrations/$name.php";
        $table_name = str_replace("create_", "", str_replace("_table", "", $name));

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $migrations = \glob("$dir/*.php");

        foreach ($migrations as $file) {
            if(\str_contains($file,"$name")) {
                echo "Migration already exists: ./database/Migrations/". \basename($file) . "\n";
                return;
            }
        }

        $file = "$dir/{$date}_$name.php";

        $content = \file_get_contents($template);

        $content = \str_replace("MigrationTable", $table_name, $content);

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "Migration created: $filePath\n";
    }

    private function buildAddColumnMigration(string $name, string $date): void {
        $template =  __DIR__ . '/../templates/AddColumnMigration.php';
        $dir = DATABASE_DIR . '/Migrations';
        $filePath = "./database/Migrations/$name.php";
        preg_match('/add_(column|columns)_(.*)_to_(.*)_table/', $name, $matches);
        $columns_str = $matches[2];
        $table_name = $matches[3];

        $columns = \explode('_and_', $columns_str);

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $migrations = \glob("$dir/*.php");

        foreach ($migrations as $file) {
            if(\str_contains($file,$name)) {
                echo "Migration already exists: ./database/Migrations/". \basename($file) . "\n";
                return;
            }
        }

        $file = "$dir/{$date}_$name.php";

        $content = \file_get_contents($template);

        if(\count($columns) > 1) {
            $content = \str_replace("MigrationTable", $table_name, $content);
            $content = \str_replace("addColumn", "addColumns", $content);
            $content = \str_replace("dropColumn", "dropColumns", $content);
            $content = \str_replace("'column_name'", "['". \implode("', '", $columns). "']", $content); 

        }else{
            $content = \str_replace("MigrationTable", $table_name, $content);
            $content = \str_replace("column_name", $columns[0], $content);
        }

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "Migration created: $filePath\n";
        
        exit(0);
    } 

    private function buildDropColumnMigration(string $name, string $date): void {
        $template =  __DIR__ . '/../templates/DropColumnMigration.php';
        $dir = DATABASE_DIR . '/Migrations';
        $filePath = "./database/Migrations/$name.php";
        preg_match('/remove_(column|columns)_(.*)_from_(.*)_table/', $name, $matches);
        $columns_str = $matches[2];
        $table_name = $matches[3];

        $columns = \explode('_and_', $columns_str);

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $migrations = \glob("$dir/*.php");

        foreach ($migrations as $file) {
            if(\str_contains($file,$name)) {
                echo "Migration already exists: ./database/Migrations/". \basename($file) . "\n";
                return;
            }
        }

        $file = "$dir/{$date}_$name.php";

        $content = \file_get_contents($template);

        if(\count($columns) > 1) {
            $content = \str_replace("MigrationTable", $table_name, $content);
            $content = \str_replace("addColumn", "addColumns", $content);
            $content = \str_replace("dropColumn", "dropColumns", $content);
            $content = \str_replace("'column_name'", "['". \implode("', '", $columns). "']", $content); 

        }else{
            $content = \str_replace("MigrationTable", $table_name, $content);
            $content = \str_replace("column_name", $columns[0], $content);
        }

        $structure = "";

        foreach ($columns as $column) {
            $structure .= Migrator::getColumnStructure($table_name, $column) . "\t\t\t";
        }

        $content = \str_replace("// Column To Add", $structure, $content);

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "Migration created: $filePath\n";
        
        exit(0);
    } 

    private function buildUpdateColumnMigration(string $name, string $date): void {
        $template =  __DIR__ . '/../templates/UpdateColumnMigration.php';
        $dir = DATABASE_DIR . '/Migrations';
        $filePath = "./database/Migrations/$name.php";
        preg_match('/update_(column|columns)_(.*)_from_(.*)_table/', $name, $matches);
        $columns_str = $matches[2];
        $table_name = $matches[3];

        $columns = \explode('_and_', $columns_str);

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $migrations = \glob("$dir/*.php");

        foreach ($migrations as $file) {
            if(\str_contains($file,$name)) {
                echo "Migration already exists: ./database/Migrations/". \basename($file) . "\n";
                return;
            }
        }

        $file = "$dir/{$date}_$name.php";

        $content = \file_get_contents($template);

        $content = \str_replace("MigrationTable", $table_name, $content);

        if(\count($columns) > 1) {
            $content = \str_replace("updateColumn", "updateColumns", $content);
        }

        $structure = "";

        foreach ($columns as $column) {
            $structure .= Migrator::getColumnStructure($table_name, $column) . "\t\t\t";
        }

        $content = \str_replace("// Column To Update", $structure, $content);

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "Migration created: $filePath\n";
        
        exit(0);
    }  

    private function buildRenameTableMigration(string $name, string $date): void {
        $template =  __DIR__ . '/../templates/RenameTableMigration.php';
        $dir = DATABASE_DIR . '/Migrations';
        $filePath = "./database/Migrations/$name.php";
        preg_match('/rename_table_(.*)_to_(.*)/', $name, $matches);
        $old_name = $matches[1];
        $new_name = $matches[2];

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $migrations = \glob("$dir/*.php");

        foreach ($migrations as $file) {
            if(\str_contains($file,$name)) {
                echo "Migration already exists: ./database/Migrations/". \basename($file) . "\n";
                return;
            }
        }

        $file = "$dir/{$date}_$name.php";

        $content = \file_get_contents($template);

        $content = \str_replace("old_table_name", $old_name, $content);
        $content = \str_replace("new_table_name", $new_name, $content);

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "Migration created: $filePath\n";
        
        exit(0);
    }

    private function buildRenameColumnMigration(string $name, string $date): void {
        $template =  __DIR__ . '/../templates/RenameColumnMigration.php';
        $dir = DATABASE_DIR . '/Migrations';
        $filePath = "./database/Migrations/$name.php";
        preg_match('/rename_(column|columns)_(.*)_from_(.*)_table/', $name, $matches);
        $columns_str = $matches[2];
        $table_name = $matches[3];

        $columns = \explode('_and_', $columns_str);

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $migrations = \glob("$dir/*.php");

        foreach ($migrations as $file) {
            if(\str_contains($file,$name)) {
                echo "Migration already exists: ./database/Migrations/". \basename($file) . "\n";
                return;
            }
        }

        $file = "$dir/{$date}_$name.php";

        $content = \file_get_contents($template);

        $content = \str_replace("table_name", $table_name, $content);

        if(\count($columns) > 1) {
            $content = \str_replace("renameColumn", "renameColumns", $content);
            $content = \str_replace("\"old_column_name\"", "['" . implode("', '", $columns) . "']", $content);
            $dump_str = [];
            foreach ($columns as $key => $column) {
                $dump_str[] = "column_{$key}";
            }
            $content = \str_replace("\"new_column_name\"", "['" . implode("', '", $dump_str) . "']", $content);
        }else{
            $content = \str_replace("old_column_name", $columns[0], $content);
            $content = \str_replace("new_column_name", "column_1", $content);
        }

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "Migration created: $filePath\n";
        
        exit(0);
    }
}
