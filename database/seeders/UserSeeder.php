<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'super_admin'
            ],
            [
                'name' => 'mahasiswa',
                'email' => 'mahasiswa@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa'
            ],
            [
                'name' => 'Admin Jurusan',
                'email' => 'admin_jurusan@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'admin_jurusan'
            ],
            [
                'name' => 'Kaprodi',
                'email' => 'kaprodi@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'kaprodi'
            ],
            [
                'name' => 'Kajur',
                'email' => 'kajur@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'kajur'
            ]
        ]);
    }
}
