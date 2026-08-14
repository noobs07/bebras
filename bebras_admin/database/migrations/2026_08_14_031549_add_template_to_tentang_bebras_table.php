<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tentang_bebras', function (Blueprint $table) {
            $table->enum('template', ['dd_1', 'dd_2', 'dd_3', 'dd_4', 'dd_5', 'dd_6'])
                  ->default('dd_1')
                  ->after('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tentang_bebras', function (Blueprint $table) {
            $table->dropColumn('template');
        });
    }
};
