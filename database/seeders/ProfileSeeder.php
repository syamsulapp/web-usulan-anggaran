<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $profile = [[
            'nama_lengkap' => 'Admin',
            'about_me' => 'Admin',
            'id_users' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ], [
            'nama_lengkap' => 'SuperAdmin',
            'about_me' => 'super admin',
            'id_users' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]];

        foreach ($profile as $p) {
            DB::table('profile')->insert($p);
        }
    }
}
