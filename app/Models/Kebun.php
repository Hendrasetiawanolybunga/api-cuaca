<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kebun extends Model
{
    protected $table = 'kebun';
    protected $primaryKey = 'kebun_id';
    protected $fillable = ['kebun_nama', 'kebun_lokasi', 'pengguna_id'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }

    public function musimTanam()
    {
        return $this->hasMany(MusimTanam::class, 'kebun_id', 'kebun_id');
    }
}
