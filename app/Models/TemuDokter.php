<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemuDokter extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'temu_dokter';

	protected $primaryKey = 'idtemu_dokter';

	public $timestamps = false;

	protected $fillable = ['no_urut', 'waktu_daftar', 'status', 'idpet', 'idrole_user', 'idrekam_medis', 'deleted_by'];

	protected $dates = ['deleted_at'];

	public function pet()
	{
		return $this->belongsTo(Pet::class, 'idpet');
	}

	public function roleUser()
	{
		return $this->belongsTo(RoleUser::class, 'idrole_user');
	}

	public function rekamMedis()
	{
		return $this->belongsTo(RekamMedis::class, 'idrekam_medis');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
