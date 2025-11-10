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
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole');
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser');
    }

    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class, 'iduser');
    }
}
