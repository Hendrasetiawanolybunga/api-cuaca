<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kebun extends Model
{
    protected $table = 'kebun';
    protected $primaryKey = 'kebun_id';
    protected $fillable = ['kebun_nama', 'kebun_lokasi', 'pengguna_id'];

    /**
     * Accessor untuk mendapatkan latitude dari kebun_lokasi
     *
     * @return float|null
     */
    public function getLatitudeAttribute()
    {
        if (empty($this->kebun_lokasi)) {
            return null;
        }
        
        $parts = explode(',', $this->kebun_lokasi);
        return count($parts) >= 1 ? (float) trim($parts[0]) : null;
    }

    /**
     * Accessor untuk mendapatkan longitude dari kebun_lokasi
     *
     * @return float|null
     */
    public function getLongitudeAttribute()
    {
        if (empty($this->kebun_lokasi)) {
            return null;
        }
        
        $parts = explode(',', $this->kebun_lokasi);
        return count($parts) >= 2 ? (float) trim($parts[1]) : null;
    }

    /**
     * Mutator untuk menyimpan kebun_lokasi dalam format yang benar
     *
     * @param array|string $value
     * @return void
     */
    public function setKebunLokasiAttribute($value)
    {
        if (is_array($value) && isset($value['latitude']) && isset($value['longitude'])) {
            $this->attributes['kebun_lokasi'] = $value['latitude'] . ',' . $value['longitude'];
        } else {
            $this->attributes['kebun_lokasi'] = $value;
        }
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }

    public function musimTanam()
    {
        return $this->hasMany(MusimTanam::class, 'kebun_id', 'kebun_id');
    }
}
