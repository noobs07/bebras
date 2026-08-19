<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->foreignId('menu_kegiatan_id')
                ->nullable()
                ->after('id')
                ->constrained('menu_kegiatan')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropForeignIdFor('menu_kegiatan_id');
            $table->dropColumn('menu_kegiatan_id');
        });
    }
};
