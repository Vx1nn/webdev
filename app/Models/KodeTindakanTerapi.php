<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KodeTindakanTerapi extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'kode_tindakan_terapi';

	protected $primaryKey = 'idkode_tindakan_terapi';

	public $timestamps = false;

	protected $fillable = [
		'kode',
		'deskripsi_tindakan_terapi',
		'idkategori',
		'idkategori_klinis',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function kategori()
	{
		return $this->belongsTo(Kategori::class, 'idkategori');
	}

	public function kategoriKlinis()
	{
		return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis');
	}

	public function detailRekamMedis()
	{
		return $this->hasMany(DetailRekamMedis::class, 'idkode_tindakan_terapi');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
