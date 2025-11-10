<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    public $timestamps = false;

    protected $fillable = ['nama_jenis_hewan'];

    public function rasHewan()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan');
    }
}
