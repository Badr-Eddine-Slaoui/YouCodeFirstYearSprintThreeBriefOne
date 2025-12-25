<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->create('role_user', function(Table $table){
            $table->id();
            $table->bigInt('role_id');
            $table->bigInt('user_id');
            $table->foreignKey('role_id')->references("roles", 'id')->onDelete('cascade');
            $table->foreignKey('user_id')->references('users', 'id')->onDelete('cascade');
        });
    }

    public function down(): void{
        $this->dropIfExists('role_user');
    }
};