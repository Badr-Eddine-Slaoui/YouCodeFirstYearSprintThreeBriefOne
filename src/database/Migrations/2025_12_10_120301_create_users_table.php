<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void{
        $this->create('users', function(Table $table){
            $table->id();
            $table->string('name')->size(30);
            $table->string('email')->size(150)->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void{
        $this->dropIfExists('users');
    }
};


