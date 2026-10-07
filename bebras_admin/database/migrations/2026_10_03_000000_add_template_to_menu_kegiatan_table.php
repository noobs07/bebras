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
        Schema::table('menu_kegiatan', function (Blueprint $table) {
            $table->enum('template', ['bebras_challenge', 'workshop', 'pengumuman_hasil'])
                  ->nullable()
                  ->after('parent_id');
        });

        // Backfill template untuk menu root berdasarkan pemetaan slug
        DB::transaction(function () {
            $pemetaan = [
                'workshop'                       => 'workshop',
                'bebras-challenge'               => 'bebras_challenge',
                'pengumuman-hasil'               => 'pengumuman_hasil',
                'ct-challenge-2023-for-teachers' => 'pengumuman_hasil',
            ];

            foreach ($pemetaan as $slug => $template) {
                DB::table('menu_kegiatan')
                    ->whereNull('parent_id')
                    ->where('slug', $slug)
                    ->update(['template' => $template]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('menu_kegiatan', 'template')) {
            Schema::table('menu_kegiatan', function (Blueprint $table) {
                $table->dropColumn('template');
            });
        }
    }
};
