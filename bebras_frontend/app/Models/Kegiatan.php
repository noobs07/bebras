<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'menu_kegiatan_id',
        'tipe',
        'judul',
        'deskripsi',
        'gambar',
        'kota',
        'tanggal_lokasi',
        'speaker',
        'urutan',
    ];

    public function menuKegiatan(): BelongsTo
    {
        return $this->belongsTo(MenuKegiatan::class, 'menu_kegiatan_id');
    }
}
