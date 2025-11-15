<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RasHewan extends Model
{
    use HasFactory;

    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    public $timestamps = false;

    protected $fillable = ['nama_ras', 'idjenis_hewan'];

    public function jenisHewan()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'idras_hewan');
    }
}

