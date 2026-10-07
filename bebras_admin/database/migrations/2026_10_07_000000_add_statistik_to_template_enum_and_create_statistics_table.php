<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah nilai 'statistik' ke ENUM kolom template di menu_kegiatan
        // Blueprint tidak mendukung modifikasi ENUM secara langsung, gunakan DB::statement
        DB::statement("ALTER TABLE menu_kegiatan MODIFY COLUMN template
            ENUM('bebras_challenge','workshop','pengumuman_hasil','statistik') NULL");

        // Buat tabel statistics
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique();
            $table->integer('si_kecil')->nullable();
            $table->integer('siaga')->nullable();
            $table->integer('penggalang')->nullable();
            $table->integer('penegak')->nullable();
            $table->integer('pria')->nullable();
            $table->integer('wanita')->nullable();
            $table->integer('sekolah')->nullable();
            $table->integer('biro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');

        // Kembalikan ENUM ke 3 nilai semula, dengan guard agar idempotent
        if (Schema::hasColumn('menu_kegiatan', 'template')) {
            DB::statement("ALTER TABLE menu_kegiatan MODIFY COLUMN template
                ENUM('bebras_challenge','workshop','pengumuman_hasil') NULL");
        }
    }
};
