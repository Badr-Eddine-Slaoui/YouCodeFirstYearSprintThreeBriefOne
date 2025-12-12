<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->updateColumns('users', function(Table $table){
            $table->string('name')->size(100);
			$table->string('email')->size(200);
        });
    }

    public function down(): void{
        $this->updateColumns('users', function(Table $table){
            $table->string('name')->size(30);
			$table->string('email')->size(150)->unique();
        });
    }
};