<?php

namespace App;

use App\Direccion;
use App\Transaccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Envio extends Model
{
	use SoftDeletes;

	protected $table = 'envio';
	protected $primaryKey = 'envio_id';
	protected $guarded =[];

	public function transaccion()
	{
		return $this->belongsTo(Transaccion::class, 'transaccion_id', 'transaccion_id');
	}

	public function direccion()
	{
		return $this->belongsTo(Direccion::class, 'direccion_id', 'direccion_id');
	}
}
