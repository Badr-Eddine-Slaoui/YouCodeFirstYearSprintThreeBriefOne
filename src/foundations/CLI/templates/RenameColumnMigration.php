<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->renameColumn("table_name","old_column_name","new_column_name");
    }

    public function down(): void{
        $this->renameColumn("table_name","new_column_name","old_column_name");
    }
};