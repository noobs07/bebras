<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalChallenge extends Model
{
    use HasFactory;

    protected $table = 'soal_challenges';

    protected $fillable = [
        'menu_soal_id',
        'kategori_umur',
        'tingkat',
        'kesulitan',
        'kategori_materi',
        'judul',
        'gambar_soal_1',
        'deskripsi_soal',
        'gambar_soal_2',
        'solusi',
        'ini_informatika',
    ];

    public function menuSoal()
    {
        return $this->belongsTo(MenuSoal::class, 'menu_soal_id');
    }

    public function options()
    {
        return $this->hasMany(SoalChallengeOption::class, 'soal_challenge_id')->orderBy('urutan', 'asc');
    }
}
