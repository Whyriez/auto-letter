<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => 'password123',
                'role' => 'super_admin',
                'nim_nip' => 'SA001',
            ],
            [
                'name' => 'Kaprodi Example',
                'email' => 'kaprodi@example.com',
                'password' => 'password123',
                'role' => 'kaprodi',
                'nim_nip' => 'KAPRODI01',
            ],
            [
                'name' => 'Kajur Example',
                'email' => 'kajur@example.com',
                'password' => 'password123',
                'role' => 'kajur',
                'nim_nip' => 'KAJUR01',
            ],
            [
                'name' => 'Admin Jurusan Example',
                'email' => 'adminjurusan@example.com',
                'password' => 'password123',
                'role' => 'admin_jurusan',
                'nim_nip' => 'AJ001',
            ],
            [
                'name' => 'Mahasiswa Example',
                'email' => 'mahasiswa@example.com',
                'password' => 'password123',
                'role' => 'mahasiswa',
                'nim_nip' => '1234567890',
            ],
            [
                'name' => 'Another Mahasiswa',
                'email' => 'mahasiswa2@example.com',
                'password' => 'password123',
                'role' => 'mahasiswa',
                'nim_nip' => '1234567891',
            ],
        ];

        // Looping untuk membuat setiap pengguna
        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role' => $userData['role'],
                'nim_nip' => $userData['nim_nip'],
                'email_verified_at' => now(), // Opsional: Atur waktu verifikasi
            ]);
        }
    }
}
