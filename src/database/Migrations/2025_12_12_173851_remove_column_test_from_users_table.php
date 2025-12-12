<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->dropColumn('users', 'test');
    }

    public function down(): void{
        $this->addColumn('users', function(Table $table){
            $table->string('test')->size(255)->nullable();

        });
    }
};