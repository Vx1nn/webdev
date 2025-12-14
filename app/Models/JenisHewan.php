<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisHewan extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'jenis_hewan';

	protected $primaryKey = 'idjenis_hewan';

	public $timestamps = false;

	protected $fillable = ['nama_jenis_hewan', 'deleted_by'];

	protected $dates = ['deleted_at'];

	public function ras()
	{
		return $this->hasMany(RasHewan::class, 'idjenis_hewan');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
