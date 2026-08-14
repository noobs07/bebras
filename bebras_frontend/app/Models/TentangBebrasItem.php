<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangBebrasItem extends Model
{
    use HasFactory;

    protected $table = 'tentang_bebras_items';

    protected $fillable = [
        'tentang_bebras_id',
        'tipe',
        'icon',
        'judul',
        'deskripsi',
        'bg_color',
        'tanggal',
        'urutan',
    ];

    public function tentangBebras()
    {
        return $this->belongsTo(TentangBebras::class, 'tentang_bebras_id');
    }
}
