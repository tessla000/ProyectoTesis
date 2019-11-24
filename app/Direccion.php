<?php

namespace App;

use App\Comuna;
use App\Envio;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
	use SoftDeletes;

	protected $table = 'direccion';
	protected $primaryKey = 'direccion_id';
	protected $guarded =[];

	public function usuario()
	{
		return $this->belongsTo(User::class, 'usuario_id', 'usuario_id');
	}
	public function comuna()
	{
		return $this->belongsTo(Comuna::class, 'comuna_id', 'comuna_id');
	}

	public function envios()
	{
		return $this->hasMany(Envio::class, 'envio_id', 'envio_id');
	}

	public function getRouteKeyName()
    {
        return 'rut';
    }
}
