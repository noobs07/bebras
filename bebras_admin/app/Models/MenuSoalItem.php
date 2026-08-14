<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSoalItem extends Model
{
    use HasFactory;

    protected $table = 'menu_soal_items';

    protected $fillable = [
        'menu_soal_id',
        'tipe',
        'judul',
        'urutan',
    ];

    public function menuSoal()
    {
        return $this->belongsTo(MenuSoal::class, 'menu_soal_id');
    }
}
