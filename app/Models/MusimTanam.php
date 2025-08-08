<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusimTanam extends Model
{
    protected $table = 'musim_tanam';
    protected $primaryKey = 'mt_id';
    protected $fillable = [
        'mt_tanggal_tanam',
        'mt_tanggal_panen',
        'mt_komoditas',
        'kebun_id'
    ];

    public function kebun()
    {
        return $this->belongsTo(Kebun::class, 'kebun_id', 'kebun_id');
    }

    public function pestisida()
    {
        return $this->hasMany(Pestisida::class, 'mt_id', 'mt_id');
    }

    public function pupuk()
    {
        return $this->hasMany(Pupuk::class, 'mt_id', 'mt_id');
    }
}
