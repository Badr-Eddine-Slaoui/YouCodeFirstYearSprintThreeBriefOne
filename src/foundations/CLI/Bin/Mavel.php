<?php

namespace Foundations\CLI\Bin;

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
            default:
                echo "Command '$this->command' not found. Use 'mavel help' for help.\n";
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
}
