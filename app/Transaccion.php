<?php

namespace App;

use App\Producto;
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

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'producto_id', 'producto_id');
	}

}
