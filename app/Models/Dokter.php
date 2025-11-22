<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
	use HasFactory;

	protected $table = 'dokter';

	protected $primaryKey = 'id_dokter';

	public $timestamps = false;

	protected $fillable = [
		'alamat',
		'no_hp',
		'bidang_dokter',
		'jenis_kelamin',
		'iduser',
	];

	public function getJenisKelaminTextAttribute()
	{
		return $this->jenis_kelamin == 'L' ? 'Laki-laki' : ($this->jenis_kelamin == 'P' ? 'Perempuan' : '-');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'iduser', 'iduser');
	}
}
