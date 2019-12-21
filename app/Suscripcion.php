<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suscripcion extends Model
{
	use SoftDeletes;

	protected $table = 'suscripcion';
	protected $primaryKey = 'suscripcion_id';
	protected $guarded =[];

	public function usuarios()
	{
		return $this->hasMany(User::class, 'usuario_id', 'usuario_id');
	}

	public function getRouteKeyName()
	{
		return 'name';
	}
}
