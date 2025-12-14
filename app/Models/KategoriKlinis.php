<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriKlinis extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'kategori_klinis';

	protected $primaryKey = 'idkategori_klinis';

	public $timestamps = false;

	protected $fillable = ['nama_kategori_klinis', 'deleted_by'];

	protected $dates = ['deleted_at'];

	public function kodeTindakanTerapi()
	{
		return $this->hasMany(KodeTindakanTerapi::class, 'idkategori_klinis');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
