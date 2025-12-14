<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'kategori';

	protected $primaryKey = 'idkategori';

	public $timestamps = false;

	protected $fillable = ['nama_kategori', 'deleted_by'];

	protected $dates = ['deleted_at'];

	public function kodeTindakanTerapi()
	{
		return $this->hasMany(KodeTindakanTerapi::class, 'idkategori');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
