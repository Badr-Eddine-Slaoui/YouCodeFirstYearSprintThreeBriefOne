<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->addColumn('users', function(Table $table){
            $table->string('test')->nullable();
        });
    }

    public function down(): void{
        $this->dropColumn('users', 'test');
    }
};