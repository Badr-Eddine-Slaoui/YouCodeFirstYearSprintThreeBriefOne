<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->create('MigrationTable', function(Table $table){
            $table->id();
            // ...
            $table->timestamps();
        });
    }

    public function down(): void{
        $this->dropIfExists('MigrationTable');
    }
};