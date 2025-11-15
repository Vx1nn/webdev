<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'iduser');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status');
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser');
    }

    public function getPrimaryRoleAttribute(): ?string
    {
        return optional($this->roles->first())->nama_role;
    }

    public function hasRole(string $roleName): bool
    {
        return $this->roles->contains('nama_role', $roleName);
    }
}
