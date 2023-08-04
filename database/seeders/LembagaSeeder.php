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
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'Bagian Umum dan Kemahasiswaan'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'Analis Kepegawaian'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'Perencanaan'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'Keuangan'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'FTIK'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'FEBI'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'FSH'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'FUAD'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'Pascasarjana'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'LPM'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'LPPM'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'TIPD'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'Makhad'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'Pusat Bahasa'
        ]);
        DB::table('lembaga')->insert([
            'nama_lembaga' => 'Perpustakaan'
        ]);
    }
}
