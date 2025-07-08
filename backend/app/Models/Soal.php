<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'kategori_id',
        'topik_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
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


