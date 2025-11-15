<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriKlinis extends Model
{
    use HasFactory;

    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $timestamps = false;

    protected $fillable = ['nama_kategori_klinis'];

    public function kodeTindakanTerapi()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori_klinis');
    }
}
