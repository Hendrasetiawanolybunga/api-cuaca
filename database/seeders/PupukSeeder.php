<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pupuk;
use App\Models\MusimTanam;

class PupukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil musim tanam untuk relasi
        $musimTanamList = MusimTanam::all();
        
        if ($musimTanamList->count() > 0) {
            // Data pupuk dummy
            $pupukData = [
                [
                    'pupuk_tanggal_pakai' => '2024-01-20',
                    'pupuk_jenis' => 'Urea',
                    'pupuk_jumlah_pakai' => '200kg/ha',
                    'mt_id' => $musimTanamList[0]->mt_id
                ],
                [
                    'pupuk_tanggal_pakai' => '2024-02-15',
                    'pupuk_jenis' => 'NPK',
                    'pupuk_jumlah_pakai' => '150kg/ha',
                    'mt_id' => $musimTanamList[0]->mt_id
                ],
                [
                    'pupuk_tanggal_pakai' => '2024-02-15',
                    'pupuk_jenis' => 'Kompos',
                    'pupuk_jumlah_pakai' => '500kg/ha',
                    'mt_id' => $musimTanamList[1]->mt_id
                ],
                [
                    'pupuk_tanggal_pakai' => '2024-03-10',
                    'pupuk_jenis' => 'NPK',
                    'pupuk_jumlah_pakai' => '100kg/ha',
                    'mt_id' => $musimTanamList[2]->mt_id
                ],
                [
                    'pupuk_tanggal_pakai' => '2024-02-05',
                    'pupuk_jenis' => 'Kandang',
                    'pupuk_jumlah_pakai' => '1000kg/ha',
                    'mt_id' => $musimTanamList[3]->mt_id
                ],
                [
                    'pupuk_tanggal_pakai' => '2024-03-01',
                    'pupuk_jenis' => 'Urea',
                    'pupuk_jumlah_pakai' => '250kg/ha',
                    'mt_id' => $musimTanamList[4]->mt_id
                ],
            ];
            
            // Insert data pupuk
            foreach ($pupukData as $pupuk) {
                Pupuk::create($pupuk);
            }
        }
    }
}