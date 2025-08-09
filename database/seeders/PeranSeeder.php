<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peran;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat peran dasar
        $peran = [
            ['peran_nama' => 'admin'],
            ['peran_nama' => 'penyuluh'],
            ['peran_nama' => 'petani'],
        ];

        // Insert data peran
        foreach ($peran as $p) {
            Peran::updateOrCreate(
                ['peran_nama' => $p['peran_nama']],
                $p
            );
        }
    }
}