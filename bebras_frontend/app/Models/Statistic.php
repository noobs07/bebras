<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statistics';

    protected $fillable = [
        'year',
        'si_kecil',
        'siaga',
        'penggalang',
        'penegak',
        'pria',
        'wanita',
        'sekolah',
        'biro',
    ];
}
