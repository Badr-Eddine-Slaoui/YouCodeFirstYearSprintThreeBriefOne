<?php

namespace Foundations\CLI\Bin;

use Foundations\DB\Migrations\Migrator;

define('ROOT_DIR', __DIR__ .'/../../..');
define('APP_DIR', __DIR__ .'/../../../app');

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
                "dir" => APP_DIR . '/Controllers'
            ],
            "ResourceController" => [
                "template"=> __DIR__ . '/../templates/ResourceController.php',
                "dir" => APP_DIR . '/Controllers'
            ]
        ];

        $dir = $dirs[$postfix]['dir'];

        if (!\is_dir($dir)) \mkdir($dir, 0777, true);

        \chmod($dir, 0777);

        $file = "$dir/$name.php";
        $filePath = "./app/Controllers/$name.php";
        
        if (\file_exists($file)) {
            echo "$postfix already exists: $filePath\n";
            return;
        }

        $content = \file_get_contents($dirs[$postfix]["template"]);

        $content = \str_replace("{$postfix}Template", $name, $content);

        \file_put_contents($file, $content);
        \chmod($file, 0777);

        echo "$postfix created: $filePath\n";
    }
}
