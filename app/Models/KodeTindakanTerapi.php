<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KodeTindakanTerapi extends Model
{
    use HasFactory;

    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'deskripsi_tindakan_terapi',
        'idkategori_klinis'
    ];

    public function kategoriKlinis()
    {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idkode_tindakan_terapi');
    }
}
