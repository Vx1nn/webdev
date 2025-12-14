<?php

namespace App\Models;

use App\Traits\RecordsDeletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemilik extends Model
{
	use HasFactory, SoftDeletes, RecordsDeletion;

	protected $table = 'pemilik';

	protected $primaryKey = 'idpemilik';

	public $incrementing = false;

	public $timestamps = false;

	protected $fillable = ['idpemilik', 'no_wa', 'alamat', 'iduser', 'deleted_by'];

	protected $dates = ['deleted_at'];

	public function user()
	{
		return $this->belongsTo(User::class, 'iduser');
	}

	public function pets()
	{
		return $this->hasMany(Pet::class, 'idpemilik');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by', 'iduser');
	}
}
