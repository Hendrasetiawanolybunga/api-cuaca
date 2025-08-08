<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'pengguna_id';
    protected $fillable = [
        'pengguna_peran',
        'pengguna_nama',
        'pengguna_email',
        'pengguna_password',
        'pengguna_lokasi',
        // 'peran_id'
    ];

    // public function peran()
    // {
    //     return $this->belongsTo(Peran::class, 'peran_id', 'peran_id');
    // }

    public function kebun()
    {
        return $this->hasMany(Kebun::class, 'pengguna_id', 'pengguna_id');
    }
}
