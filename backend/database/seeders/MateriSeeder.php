<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('materis')->insert([
            [
                'judul' => 'Dasar Pemrograman Java',
                'deskripsi' => 'Pelajari konsep dasar Java seperti variabel, tipe data, dan struktur kontrol.',
                'label' => 'Java',
                'konten' => 'Materi lengkap dasar Java akan dibahas di sini.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'OOP dengan Java',
                'deskripsi' => 'Pahami konsep Object-Oriented Programming di Java seperti class, inheritance, dan interface.',
                'label' => 'Java',
                'konten' => 'Materi OOP di Java meliputi class, inheritance, dll.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pemrograman C untuk Pemula',
                'deskripsi' => 'Memahami syntax dasar C, pointer, dan manajemen memori.',
                'label' => 'C',
                'konten' => 'Dasar-dasar pemrograman C untuk pemula akan dijelaskan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Struktur Data dengan C',
                'deskripsi' => 'Pelajari struktur data seperti linked list, stack, dan queue menggunakan C.',
                'label' => 'C',
                'konten' => 'Struktur data di C termasuk stack, queue, dan linked list.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Python Fundamental',
                'deskripsi' => 'Belajar Python dari dasar: variabel, fungsi, dan manipulasi data.',
                'label' => 'Python',
                'konten' => 'Fundamental Python untuk pemula dibahas di sini.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Automasi dengan Python',
                'deskripsi' => 'Gunakan Python untuk otomasi tugas, scraping, dan pengolahan file.',
                'label' => 'Python',
                'konten' => 'Bahas penggunaan Python untuk automasi sehari-hari.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
