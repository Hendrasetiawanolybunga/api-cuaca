<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kebun;
use App\Models\Pengguna;

class KebunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil pengguna petani untuk relasi
        $petaniList = Pengguna::where('pengguna_peran', 'petani')->get();
        
        if ($petaniList->count() > 0) {
            // Data kebun dummy
            $kebunData = [
                [
                    'kebun_nama' => 'Kebun Jagung Ahmad',
                    'kebun_lokasi' => '-10.1823,123.5987',
                    'pengguna_id' => $petaniList[0]->pengguna_id
                ],
                [
                    'kebun_nama' => 'Kebun Kacang Ahmad',
                    'kebun_lokasi' => '-10.1756,123.6089',
                    'pengguna_id' => $petaniList[0]->pengguna_id
                ],
                [
                    'kebun_nama' => 'Kebun Sayur Siti',
                    'kebun_lokasi' => '-10.2045,123.4667',
                    'pengguna_id' => $petaniList[1]->pengguna_id
                ],
                [
                    'kebun_nama' => 'Kebun Buah Siti',
                    'kebun_lokasi' => '-10.1934,123.7590',
                    'pengguna_id' => $petaniList[1]->pengguna_id
                ],
                [
                    'kebun_nama' => 'Kebun Padi Joko',
                    'kebun_lokasi' => '-10.1683,123.5837',
                    'pengguna_id' => $petaniList[2]->pengguna_id
                ],
            ];
            
            // Insert data kebun
            foreach ($kebunData as $kebun) {
                Kebun::updateOrCreate(
                    ['kebun_nama' => $kebun['kebun_nama'], 'pengguna_id' => $kebun['pengguna_id']],
                    $kebun
                );
            }
        }
    }
}