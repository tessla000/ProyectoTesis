<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
	use SoftDeletes;

	protected $table = 'rol';
	protected $primaryKey = 'rol_id';
	protected $guarded =[];

	public function users()
	{
		return $this->hasMany(User::class, 'usuario_id', 'usuario_id');
	}

	public function getRouteKeyName()
    {
        return 'name';
    }
}
