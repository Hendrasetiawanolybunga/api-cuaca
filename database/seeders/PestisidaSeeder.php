<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pestisida;
use App\Models\MusimTanam;

class PestisidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil musim tanam untuk relasi
        $musimTanamList = MusimTanam::all();
        
        if ($musimTanamList->count() > 0) {
            // Data pestisida dummy
            $pestisidaData = [
                [
                    'pestisida_tanggal_pakai' => '2024-01-30',
                    'pestisida_jenis' => 'Insektisida',
                    'pestisida_dosis_pakai' => '200ml/ha',
                    'mt_id' => $musimTanamList[0]->mt_id
                ],
                [
                    'pestisida_tanggal_pakai' => '2024-02-25',
                    'pestisida_jenis' => 'Fungisida',
                    'pestisida_dosis_pakai' => '150ml/ha',
                    'mt_id' => $musimTanamList[0]->mt_id
                ],
                [
                    'pestisida_tanggal_pakai' => '2024-02-20',
                    'pestisida_jenis' => 'Herbisida',
                    'pestisida_dosis_pakai' => '300ml/ha',
                    'mt_id' => $musimTanamList[1]->mt_id
                ],
                [
                    'pestisida_tanggal_pakai' => '2024-03-15',
                    'pestisida_jenis' => 'Insektisida',
                    'pestisida_dosis_pakai' => '250ml/ha',
                    'mt_id' => $musimTanamList[2]->mt_id
                ],
                [
                    'pestisida_tanggal_pakai' => '2024-02-10',
                    'pestisida_jenis' => 'Fungisida',
                    'pestisida_dosis_pakai' => '200ml/ha',
                    'mt_id' => $musimTanamList[3]->mt_id
                ],
                [
                    'pestisida_tanggal_pakai' => '2024-03-05',
                    'pestisida_jenis' => 'Insektisida',
                    'pestisida_dosis_pakai' => '300ml/ha',
                    'mt_id' => $musimTanamList[4]->mt_id
                ],
            ];
            
            // Insert data pestisida
            foreach ($pestisidaData as $pestisida) {
                Pestisida::create($pestisida);
            }
        }
    }
}