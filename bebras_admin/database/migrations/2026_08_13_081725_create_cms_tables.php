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
        // 1. banners
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('gambar');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 2. settings
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // 3. kegiatans
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('tipe'); // 'kegiatan_utama', 'workshop_2017'
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('kota')->nullable();
            $table->string('tanggal_lokasi')->nullable();
            $table->string('speaker')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 4. tentang_bebras_items
        Schema::create('tentang_bebras_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tentang_bebras_id')->constrained('tentang_bebras')->cascadeOnDelete();
            $table->string('tipe'); // 'tujuan', 'ruang_lingkup', 'timeline', 'kategori_tantangan'
            $table->string('icon')->nullable(); // emoji or SVG or class
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('tanggal')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 5. menu_soal_items
        Schema::create('menu_soal_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_soal_id')->constrained('menu_soal')->cascadeOnDelete();
            $table->string('tipe'); // 'konsep', 'kriteria'
            $table->string('judul');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 6. soal_books
        Schema::create('soal_books', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // 'sikecil', 'siaga', 'penggalang', 'penegak'
            $table->string('judul');
            $table->string('pdf_link');
            $table->string('cover_image')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 7. soal_challenges
        Schema::create('soal_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_soal_id')->constrained('menu_soal')->cascadeOnDelete();
            $table->string('kategori_umur')->nullable();
            $table->string('tingkat'); // 'SD', 'SMP', 'SMA'
            $table->string('kesulitan'); // 'Mudah', 'Menengah', etc
            $table->string('kategori_materi');
            $table->string('judul');
            $table->string('gambar_soal_1')->nullable();
            $table->text('deskripsi_soal')->nullable();
            $table->string('gambar_soal_2')->nullable();
            $table->text('solusi')->nullable();
            $table->text('ini_informatika')->nullable();
            $table->timestamps();
        });

        // 8. soal_challenge_options
        Schema::create('soal_challenge_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_challenge_id')->constrained('soal_challenges')->cascadeOnDelete();
            $table->string('label'); // 'A', 'B', 'C', 'D'
            $table->text('teks')->nullable();
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_challenge_options');
        Schema::dropIfExists('soal_challenges');
        Schema::dropIfExists('soal_books');
        Schema::dropIfExists('menu_soal_items');
        Schema::dropIfExists('tentang_bebras_items');
        Schema::dropIfExists('kegiatans');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('banners');
    }
};
