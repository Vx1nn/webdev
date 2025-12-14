<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RasHewan extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'ras_hewan';

	protected $primaryKey = 'idras_hewan';

	public $timestamps = false;

	protected $fillable = ['nama_ras', 'idjenis_hewan', 'deleted_by'];

	protected $dates = ['deleted_at'];

	public function jenisHewan()
	{
		return $this->belongsTo(JenisHewan::class, 'idjenis_hewan');
	}

	public function pets()
	{
		return $this->hasMany(Pet::class, 'idras_hewan');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
