<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeTerapi extends Model
{
    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    public $timestamps = false;

    protected $fillable = ['kode', 'deskripsi_tindakan_terapi'];
}
