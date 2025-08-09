<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MusimTanam;
use App\Models\Kebun;

class MusimTanamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil kebun untuk relasi
        $kebunList = Kebun::all();
        
        if ($kebunList->count() > 0) {
            // Data musim tanam dummy
            $musimTanamData = [
                [
                    'mt_tanggal_tanam' => '2024-01-15',
                    'mt_tanggal_panen' => '2024-04-15',
                    'mt_komoditas' => 'Jagung',
                    'kebun_id' => $kebunList[0]->kebun_id
                ],
                [
                    'mt_tanggal_tanam' => '2024-02-10',
                    'mt_tanggal_panen' => '2024-05-10',
                    'mt_komoditas' => 'Kacang Tanah',
                    'kebun_id' => $kebunList[1]->kebun_id
                ],
                [
                    'mt_tanggal_tanam' => '2024-03-05',
                    'mt_tanggal_panen' => '2024-04-20',
                    'mt_komoditas' => 'Bayam',
                    'kebun_id' => $kebunList[2]->kebun_id
                ],
                [
                    'mt_tanggal_tanam' => '2024-01-20',
                    'mt_tanggal_panen' => '2024-07-20',
                    'mt_komoditas' => 'Pepaya',
                    'kebun_id' => $kebunList[3]->kebun_id
                ],
                [
                    'mt_tanggal_tanam' => '2024-02-25',
                    'mt_tanggal_panen' => '2024-06-25',
                    'mt_komoditas' => 'Padi',
                    'kebun_id' => $kebunList[4]->kebun_id
                ],
                [
                    'mt_tanggal_tanam' => '2024-05-15',
                    'mt_tanggal_panen' => '2024-08-15',
                    'mt_komoditas' => 'Jagung',
                    'kebun_id' => $kebunList[0]->kebun_id
                ],
            ];
            
            // Insert data musim tanam
            foreach ($musimTanamData as $musimTanam) {
                MusimTanam::create($musimTanam);
            }
        }
    }
}