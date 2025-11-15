<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;

    protected $fillable = ['nama_role'];

    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'idrole');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser');
    }
}
