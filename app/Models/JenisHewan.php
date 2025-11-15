<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisHewan extends Model
{
    use HasFactory;

    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    public $timestamps = false;

    protected $fillable = ['nama_jenis_hewan'];

    public function ras()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan');
    }
}
