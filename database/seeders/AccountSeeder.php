<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $account = [
            [
                'username' => 'superadmin',
                'password' => Hash::make('superadmin1129321!@#'),
                'id_lembaga' => 1,
                'id_role' => 1, //superadmin
                'is_active' => 'Y',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'username' => 'admin',
                'password' => Hash::make('admin1129321!@#'),
                'id_lembaga' => 1,
                'id_role' => 2, //admin
                'is_active' => 'Y',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),

            ], [
                'username' => 'dummy1',
                'password' => Hash::make('dummy12345'),
                'id_lembaga' => 1,
                'id_role' => 3,
                'is_active' => 'Y',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'username' => 'dummy2',
                'password' => Hash::make('dummy123456'),
                'id_lembaga' => 1,
                'id_role' => 3,
                'is_active' => 'Y',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ];
        foreach ($account as $a) {
            DB::table('users')->insert($a);
        }
    }
}
