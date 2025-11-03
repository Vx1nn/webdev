<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeTerapi extends Model
{
    use HasFactory;

    protected $table = 'kode_terapi';
    protected $primaryKey = 'idkode_terapi';
    protected $fillable = ['kode', 'nama_terapi', 'harga'];
    public $timestamps = false;
}
