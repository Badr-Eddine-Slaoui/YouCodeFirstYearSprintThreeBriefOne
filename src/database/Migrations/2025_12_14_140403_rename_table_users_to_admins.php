<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->renameTable("users","admins");
    }

    public function down(): void{
        $this->renameTable("admins","users");
    }
};