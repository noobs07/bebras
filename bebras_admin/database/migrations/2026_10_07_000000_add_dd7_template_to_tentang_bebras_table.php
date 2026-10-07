<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tentang_bebras MODIFY template ENUM('dd_1', 'dd_2', 'dd_3', 'dd_4', 'dd_5', 'dd_6', 'dd_7') NOT NULL DEFAULT 'dd_1'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tentang_bebras MODIFY template ENUM('dd_1', 'dd_2', 'dd_3', 'dd_4', 'dd_5', 'dd_6') NOT NULL DEFAULT 'dd_1'");
    }
};
