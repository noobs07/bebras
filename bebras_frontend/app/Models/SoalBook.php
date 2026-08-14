<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalBook extends Model
{
    use HasFactory;

    protected $table = 'soal_books';

    protected $fillable = [
        'kategori',
        'judul',
        'pdf_link',
        'cover_image',
        'urutan',
    ];
}
