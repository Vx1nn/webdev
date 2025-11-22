<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
	use HasFactory;

	protected $table = 'perawat';

	protected $primaryKey = 'id_perawat';

	public $timestamps = false;

	protected $fillable = [
		'alamat',
		'no_hp',
		'jenis_kelamin',
		'pendidikan',
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
