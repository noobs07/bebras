<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuKegiatan extends Model
{
    use HasFactory;

    protected $table = 'menu_kegiatan';

    protected $fillable = [
        'parent_id',
        'nama_menu',
        'slug',
        'judul',
        'body',
        'gambar',
        'url',
        'urutan',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuKegiatan::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuKegiatan::class, 'parent_id')->orderBy('urutan');
    }

    public function kegiatans(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'menu_kegiatan_id')->orderBy('urutan');
    }
}
