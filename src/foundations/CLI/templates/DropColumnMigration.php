<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->dropColumn('MigrationTable', 'column_name');
    }

    public function down(): void{
        $this->addColumn('MigrationTable', function(Table $table){
            // Column To Add
        });
    }
};