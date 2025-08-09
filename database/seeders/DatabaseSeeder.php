<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\Peran;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat peran admin
        Peran::create([
            'peran_nama' => 'Admin',
        ]);

        // Buat pengguna admin default
        Pengguna::create([
            'pengguna_nama' => 'Admin',
            'pengguna_email' => 'admin@gmail.com',
            'pengguna_password' => Hash::make('password'),
            'pengguna_peran' => 'admin',
            'pengguna_lokasi' => 'Kantor Pusat',
        ]);
    }
}