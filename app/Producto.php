<?php

namespace App;

use App\Categoria;
use App\Marca;
use App\Transaccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
	use SoftDeletes;

	protected $table = 'producto';
	protected $primaryKey = 'producto_id';
	protected $guarded =[];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class, 'categoria_id', 'categoria_id');
	}

	public function marca()
	{
		return $this->belongsTo(Marca::class, 'marca_id', 'marca_id');
	}

	public function transaccions()
    {
        return $this->hasMany(Transaccion::class, 'transaccion_id', 'transaccion_id');
    }

	public function getRouteKeyName()
    {
        return 'name';
    }
}
