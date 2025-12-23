<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->create('posts', function(Table $table){
            $table->id();
            $table->string('name')->size(150);
            $table->text('description')->nullable();
            $table->bigInt('user_id');
            $table->foreignKey('user_id')->references("users", 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void{
        $this->dropIfExists('posts');
    }
};