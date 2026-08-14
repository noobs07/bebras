<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalChallengeOption extends Model
{
    use HasFactory;

    protected $table = 'soal_challenge_options';

    protected $fillable = [
        'soal_challenge_id',
        'label',
        'teks',
        'gambar',
        'urutan',
    ];

    public function challenge()
    {
        return $this->belongsTo(SoalChallenge::class, 'soal_challenge_id');
    }
}
