<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class LembagaSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $namaLembaga = [
            'Bagian Umum dan Kemahasiswaan', 'Analis Kepegawaian', 'Perencanaan',
            'Keuangan', 'FTIK', 'FEBI', 'FSH', 'FUAD', 'Pascasarjana', 'LPM', 'LPPM', 'TIPD', 'Makhad', 'Pusat Bahasa', 'Perpustakaan'
        ];

        foreach ($namaLembaga as $nama => $lembaga) {
            DB::table('lembaga')->insert(['nama_lembaga' => $lembaga]);
        }
    }
}
