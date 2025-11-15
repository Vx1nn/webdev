<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idpet',
        'dokter_pemeriksa'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis');
    }
}
