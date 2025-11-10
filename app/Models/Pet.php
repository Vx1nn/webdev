<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama', 'tanggal_lahir', 'warna_tanda',
        'jenis_kelamin', 'idpemilik', 'idras_hewan'
    ];

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik');
    }

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan');
    }

    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idpet');
    }
}
