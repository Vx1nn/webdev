<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'role_user';

	protected $primaryKey = 'idrole_user';

	public $timestamps = false;

	protected $fillable = ['iduser', 'idrole', 'status', 'deleted_by'];

	protected $dates = ['deleted_at'];

	public function user()
	{
		return $this->belongsTo(User::class, 'iduser');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'idrole');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}

	public function rekamMedis()
	{
		return $this->hasMany(RekamMedis::class, 'dokter_pemeriksa');
	}
}
