<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Soal;

class SoalSeeder extends Seeder
{
    public function run()
    {
        Soal::insert([
            [
                'kategori_id' => 1,
                'topik_id' => 1,
                'pertanyaan' => 'Manakah yang merupakan tipe data bilangan bulat di Python?',
                'opsi_a' => 'int',
                'opsi_b' => 'float',
                'opsi_c' => 'string',
                'opsi_d' => 'boolean',
                'jawaban_benar' => 'a',
            ],
            [
                'kategori_id' => 2,
                'topik_id' => 2,
                'pertanyaan' => 'Bagaimana cara mendeklarasikan variabel di JavaScript?',
                'opsi_a' => 'var x = 5;',
                'opsi_b' => 'int x = 5;',
                'opsi_c' => 'x = 5;',
                'opsi_d' => 'variable x = 5;',
                'jawaban_benar' => 'a',
            ],
            [
                'kategori_id' => 3,
                'topik_id' => 2,
                'pertanyaan' => 'Apa output dari kode berikut: for (int i = 0; i < 3; i++) { cout << i << " "; }',
                'opsi_a' => '0 1 2',
                'opsi_b' => '1 2 3',
                'opsi_c' => '0 1 2 3',
                'opsi_d' => '1 2',
                'jawaban_benar' => 'a',
            ],
        ]);
    }
}
