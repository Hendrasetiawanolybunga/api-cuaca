<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pestisida extends Model
{
    protected $table = 'pestisida';
    protected $primaryKey = 'pestisida_id';
    protected $fillable = [
        'pestisida_tanggal_pakai',
        'pestisida_jenis',
        'pestisida_dosis_pakai',
        'mt_id'
    ];

    public function musimTanam()
    {
        return $this->belongsTo(MusimTanam::class, 'mt_id', 'mt_id');
    }
}
