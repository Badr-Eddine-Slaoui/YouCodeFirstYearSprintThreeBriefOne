<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->updateColumn('MigrationTable', function(Table $table){
            // ...
        });
    }

    public function down(): void{
        $this->updateColumn('MigrationTable', function(Table $table){
            // Column To Update
        });
    }
};