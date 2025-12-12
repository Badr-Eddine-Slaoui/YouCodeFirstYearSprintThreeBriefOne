<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->dropColumns('users', ['adress', 'city']);
    }

    public function down(): void{
        $this->addColumns('users', function(Table $table){
            $table->string('adress')->size(255)->nullable();
			$table->string('city')->size(255)->default('Safi');
			
        });
    }
};