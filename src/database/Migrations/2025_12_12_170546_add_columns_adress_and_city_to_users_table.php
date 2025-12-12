<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->addColumns('users', function(Table $table){
            $table->string('adress')->nullable();
            $table->string('city')->default('Safi');
        });
    }

    public function down(): void{
        $this->dropColumns('users', ['adress', 'city']);
    }
};