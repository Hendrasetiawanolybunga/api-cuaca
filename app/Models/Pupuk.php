<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pupuk extends Model
{
    protected $table = 'pupuk';
    protected $primaryKey = 'pupuk_id';
    protected $fillable = [
        'pupuk_tanggal_pakai',
        'pupuk_jenis',
        'pupuk_jumlah_pakai',
        'mt_id'
    ];

    public function musimTanam()
    {
        return $this->belongsTo(MusimTanam::class, 'mt_id', 'mt_id');
    }
}
