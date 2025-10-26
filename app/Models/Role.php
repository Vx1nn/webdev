<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;

    protected $fillable = ['nama_role'];

    // jika butuh semua user dari role ini
    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'role_user',
            'idrole',   // foreignKey on pivot that refers to this model
            'iduser',   // related key on pivot that refers to other model
            'idrole',   // local key
            'iduser'    // related key on users table
        );
    }
}
