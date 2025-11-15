<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    protected $fillable = ['no_wa', 'alamat', 'iduser'];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik');
    }
}
