<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use HasFactory, Notifiable, SoftDeletes, RecordsDeletion;

	protected $table = 'user';

	protected $primaryKey = 'iduser';

	public $timestamps = false;

	protected $fillable = [
		'nama',
		'email',
		'password',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

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

	public function hasActiveRole(string $roleName): bool
	{
		return $this->roles()
			->whereRaw('LOWER(role.nama_role) = ?', [strtolower($roleName)])
			->wherePivot('status', 1)
			->exists();
	}

	public function getActiveRoles()
	{
		return $this->roles()
			->wherePivot('status', 1)
			->get()
			->pluck('nama_role')
			->map(fn($role) => strtolower($role))
			->toArray();
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
