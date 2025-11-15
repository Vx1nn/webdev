<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan'
    ];

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    public function jenisHewan()
    {
        return $this->hasOneThrough(
            JenisHewan::class,
            RasHewan::class,
            'idras_hewan',
            'idjenis_hewan',
            'idras_hewan',
            'idjenis_hewan'
        );
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet');
    }
}