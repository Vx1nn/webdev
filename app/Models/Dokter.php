<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'dokter';

	protected $primaryKey = 'id_dokter';

	public $timestamps = false;

	protected $fillable = [
		'alamat',
		'no_hp',
		'bidang_dokter',
		'jenis_kelamin',
		'iduser',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getJenisKelaminTextAttribute()
	{
		return $this->jenis_kelamin == 'L' ? 'Laki-laki' : ($this->jenis_kelamin == 'P' ? 'Perempuan' : '-');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'iduser', 'iduser');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
