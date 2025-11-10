<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;

    protected $fillable = [
        'idreservasi_dokter',
        'anamesis',
        'temuan_klinis',
        'diagnosa',
        'dokter_pemeriksa'
    ];

    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter');
    }

    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis');
    }
}
