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

    /**
     * Relasi many-to-many via pivot role_user (meskipun saat ini user nampaknya hanya 1 role)
     * pivot: role_user(idrole, iduser)
     */
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'iduser', // foreign key on pivot that refers to this model (user)
            'idrole', // foreign key on pivot that refers to Role model
            'iduser', // local key on users table
            'idrole'  // local key on roles table
        );
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'iduser', 'iduser');
    }
    /**
     * Helper: ambil role utama (string) — null jika tidak ada
     */
    public function getPrimaryRoleAttribute()
    {
        $role = $this->roles()->first();
        return $role ? $role->nama_role : null;
    }
}
