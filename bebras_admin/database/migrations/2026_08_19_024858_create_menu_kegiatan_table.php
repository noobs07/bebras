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
        Schema::create('menu_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('menu_kegiatan')->cascadeOnDelete();
            $table->string('nama_menu', 255);
            $table->string('slug', 255)->unique();
            $table->string('judul')->nullable();
            $table->longText('body')->nullable();
            $table->string('gambar')->nullable();
            $table->string('url')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_kegiatan');
    }
};
