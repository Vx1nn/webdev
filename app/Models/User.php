<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password'];


    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'iduser',
            'idrole',
            'iduser',
            'idrole'
        );
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'iduser', 'iduser');
    }

    public function getPrimaryRoleAttribute()
    {
        $role = $this->roles()->first();
        return $role ? strtolower($role->nama_role) : null;
    }

}
