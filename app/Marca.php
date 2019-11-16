<?php

namespace App;

use App\Producto;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
	use SoftDeletes;

	protected $table = 'marca';
	protected $primaryKey = 'marca_id';
	protected $guarded =[];

	public function productos()
	{
		return $this->hasMany(Producto::class, 'producto_id', 'producto_id');
	}

	public function usuario()
	{
		return $this->belongsTo(User::class, 'usuario_id', 'usuario_id');
	}

	public function getRouteKeyName()
    {
        return 'name';
    }
}
