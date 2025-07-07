<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;
    
    protected $table = 'materi';

    protected $fillable = [
        'kategori_id',
        'topik_id',
        'judul',
        'deskripsi',
        'konten',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function topik()
    {
        return $this->belongsTo(Topik::class);
    }
}
