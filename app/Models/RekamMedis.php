<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekamMedis extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'rekam_medis';

	protected $primaryKey = 'idrekam_medis';

	public $timestamps = false;

	protected $fillable = [
		'created_at',
		'anamnesa',
		'temuan_klinis',
		'diagnosa',
		'idpet',
		'dokter_pemeriksa',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function pet()
	{
		return $this->belongsTo(Pet::class, 'idpet');
	}

	public function dokter()
	{
		return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa');
	}

	public function detailRekamMedis()
	{
		return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
