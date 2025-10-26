<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $timestamps = false;

    protected $fillable = ['nama_kategori'];

    public function pet()
    {
        return $this->hasMany(Pet::class, 'idkategori', 'idkategori');
    }
}
