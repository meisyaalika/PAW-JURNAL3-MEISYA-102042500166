<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Pengguna LMS (1 Dosen & 1 Mahasiswa)
        
        // TODO 1 : Buat akun awal untuk Dosen.
        User::updateOrCreate(
            ['email' => 'budi.santoso@telkomuniversity.ac.id'],
            [
                'name'        => 'Dr. Ir. Budi Santoso, M.T.',
                'password'    => Hash::make('password123'),
                'role'        => 'dosen',
                'nomor_induk' => '198001012025011001',
            ]
        );

        // TODO 2 : Buat akun awal untuk Mahasiswa.
        User::updateOrCreate(
            ['email' => 'meisyadwialika@student.telkomuniversity.ac.id'],
            [
                'name'        => 'Meisya Dwi Alika',
                'password'    => Hash::make('meisya123'),
                'role'        => 'mahasiswa',
                'nomor_induk' => '102042500166',
            ]
        );
    }
}