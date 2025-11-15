<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemuDokter extends Model
{
    use HasFactory;
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idtemu_dokter';
    public $timestamps = false;

    protected $fillable = ['no_urut','waktu_daftar','status','idpet','idrole_user','idrekam_medis'];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet');
    }

    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user');
    }

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis');
    }
}
