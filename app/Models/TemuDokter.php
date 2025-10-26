<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $timestamps = false;
    protected $fillable = ['no_urut','waktu_daftar','status','idpet','idrole_user'];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }
    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }
}
