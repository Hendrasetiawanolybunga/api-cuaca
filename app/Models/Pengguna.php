<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;
    
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
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pengguna_password',
        'remember_token',
    ];
    
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->pengguna_password;
    }
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function getEmailAttribute()
    {
        return $this->pengguna_email;
    }
    
    /**
     * Get the user's name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->pengguna_nama;
    }

    /**
     * Get the role that owns the user.
     */
    public function peran()
    {
        return $this->belongsTo(Peran::class, 'pengguna_peran', 'peran_nama');
    }

    public function kebun()
    {
        return $this->hasMany(Kebun::class, 'pengguna_id', 'pengguna_id');
    }
}