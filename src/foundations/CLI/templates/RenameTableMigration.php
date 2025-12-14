<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->renameTable("old_table_name","new_table_name");
    }

    public function down(): void{
        $this->renameTable("new_table_name","old_table_name");
    }
};