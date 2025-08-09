<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\Peran;
use App\Models\Kebun;
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
        $admin = Pengguna::create([
            'pengguna_nama' => 'Admin',
            'pengguna_email' => 'admin@gmail.com',
            'pengguna_password' => Hash::make('password'),
            'pengguna_peran' => 'admin',
            'pengguna_lokasi' => 'Kantor Pusat',
        ]);
        
        // Buat data kebun contoh
        $kebunData = [
            [
                'kebun_nama' => 'Kebun Jagung Kupang Tengah',
                'kebun_lokasi' => '-10.1783,123.5937', // Format: latitude,longitude
                'pengguna_id' => $admin->pengguna_id
            ],
            [
                'kebun_nama' => 'Kebun Kacang Kupang Timur',
                'kebun_lokasi' => '-10.1456,123.6789',
                'pengguna_id' => $admin->pengguna_id
            ],
            [
                'kebun_nama' => 'Kebun Sayur Kupang Barat',
                'kebun_lokasi' => '-10.2145,123.4567',
                'pengguna_id' => $admin->pengguna_id
            ],
            [
                'kebun_nama' => 'Kebun Buah Amarasi',
                'kebun_lokasi' => '-10.1234,123.7890',
                'pengguna_id' => $admin->pengguna_id
            ],
        ];
        
        foreach ($kebunData as $kebun) {
            Kebun::create($kebun);
        }
    }
}