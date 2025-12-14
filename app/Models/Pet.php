<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'pet';

	protected $primaryKey = 'idpet';

	public $timestamps = false;

	protected $fillable = [
		'nama',
		'tanggal_lahir',
		'warna_tanda',
		'jenis_kelamin',
		'idpemilik',
		'idras_hewan',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function rasHewan()
	{
		return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
	}

	public function jenisHewan()
	{
		return $this->hasOneThrough(
			JenisHewan::class,
			RasHewan::class,
			'idras_hewan',
			'idjenis_hewan',
			'idras_hewan',
			'idjenis_hewan'
		);
	}

	public function pemilik()
	{
		return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
	}

	public function temuDokter()
	{
		return $this->hasMany(TemuDokter::class, 'idpet');
	}

	public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet');
    }

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
