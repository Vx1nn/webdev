<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $timestamps = false;

    protected $fillable = ['iduser', 'idrole', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_pemeriksa');
    }

    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idrole_user');
    }
}
