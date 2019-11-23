<?php

namespace App;

use App\Producto;
use App\Transaccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orden extends Model
{
	use SoftDeletes;

	protected $table = 'orden';
	protected $primaryKey = 'orden_id';
	protected $guarded =[];

	public function transaccion()
	{
		return $this->belongsTo(Transaccion::class, 'transaccion_id', 'transaccion_id');
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'producto_id', 'producto_id');
	}
}
