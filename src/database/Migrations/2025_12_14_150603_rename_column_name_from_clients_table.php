<?php

namespace Database\Migrations;

use Foundations\DB\Migrations\Migration;
use Foundations\DB\Migrations\Table;

return new class extends Migration{
    public function up(): void {
        $this->renameColumn("clients","name","column_1");
    }

    public function down(): void{
        $this->renameColumn("clients","column_1","name");
    }
};