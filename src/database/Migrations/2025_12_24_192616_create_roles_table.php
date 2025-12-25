<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->create('roles', function(Table $table){
            $table->id();
            $table->string('name')->size(30);
            $table->timestamps();
        });
    }

    public function down(): void{
        $this->dropIfExists('roles');
    }
};