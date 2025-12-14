<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'role';

	protected $primaryKey = 'idrole';

	public $timestamps = false;

	protected $fillable = ['nama_role', 'deleted_by'];

	protected $dates = ['deleted_at'];

	public function roleUser()
	{
		return $this->hasMany(RoleUser::class, 'idrole');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
