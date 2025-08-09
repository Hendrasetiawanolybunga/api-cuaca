<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use App\Models\Peran;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil peran yang tersedia
        $penyuluhRole = Peran::where('peran_nama', 'penyuluh')->first();
        $petaniRole = Peran::where('peran_nama', 'petani')->first();
        
        // Data pengguna dummy
        $penggunaData = [
            [
                'pengguna_nama' => 'Budi Santoso',
                'pengguna_email' => 'budi@gmail.com',
                'pengguna_password' => Hash::make('password'),
                'pengguna_peran' => 'penyuluh',
                'peran_id' => $penyuluhRole->peran_id,
                'pengguna_lokasi' => 'Kupang Tengah',
            ],
            [
                'pengguna_nama' => 'Dewi Lestari',
                'pengguna_email' => 'dewi@gmail.com',
                'pengguna_password' => Hash::make('password'),
                'pengguna_peran' => 'penyuluh',
                'peran_id' => $penyuluhRole->peran_id,
                'pengguna_lokasi' => 'Kupang Timur',
            ],
            [
                'pengguna_nama' => 'Ahmad Rizki',
                'pengguna_email' => 'ahmad@gmail.com',
                'pengguna_password' => Hash::make('password'),
                'pengguna_peran' => 'petani',
                'peran_id' => $petaniRole->peran_id,
                'pengguna_lokasi' => 'Amarasi',
            ],
            [
                'pengguna_nama' => 'Siti Rahayu',
                'pengguna_email' => 'siti@gmail.com',
                'pengguna_password' => Hash::make('password'),
                'pengguna_peran' => 'petani',
                'peran_id' => $petaniRole->peran_id,
                'pengguna_lokasi' => 'Kupang Barat',
            ],
            [
                'pengguna_nama' => 'Joko Widodo',
                'pengguna_email' => 'joko@gmail.com',
                'pengguna_password' => Hash::make('password'),
                'pengguna_peran' => 'petani',
                'peran_id' => $petaniRole->peran_id,
                'pengguna_lokasi' => 'Kupang Tengah',
            ],
        ];
        
        // Insert data pengguna
        foreach ($penggunaData as $pengguna) {
            Pengguna::updateOrCreate(
                ['pengguna_email' => $pengguna['pengguna_email']],
                $pengguna
            );
        }
    }
}