<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'label',
        'konten',
        'gambar',
        'author_id'
    ];

        // Relasi ke tabel users (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
