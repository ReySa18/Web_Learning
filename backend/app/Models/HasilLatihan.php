<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilLatihan extends Model
{
    use HasFactory;

    protected $table = 'hasil_latihan';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'topik_id',
        'skor',
        'jumlah_benar',
        'jumlah_salah',
    ];

    // Relasi opsional
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function topik()
    {
        return $this->belongsTo(Topik::class);
    }
}
