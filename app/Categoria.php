<?php

namespace App;

use App\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
	use SoftDeletes;

	protected $table = 'categoria';
	protected $primaryKey = 'categoria_id';
	protected $guarded =[];

	public function productos()
	{
		return $this->hasMany(Producto::class, 'producto_id', 'producto_id');
	}

	public function getRouteKeyName()
    {
        return 'name';
    }
}
