<?php

namespace App;

use App\Orden;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaccion extends Model
{
	use SoftDeletes;

	protected $table = 'transaccion';
	protected $primaryKey = 'transaccion_id';
	protected $guarded =[];

	public function usuario()
	{
		return $this->belongsTo(User::class, 'usuario_id', 'usuario_id');
	}

	public function ordens()
	{
		return $this->hasMany(Orden::class, 'orden_id', 'orden_id');
	}

}
