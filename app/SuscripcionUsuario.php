<?php

namespace App;

use App\Suscripcion;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuscripcionUsuario extends Model
{
	use SoftDeletes;

	protected $table = 'suscripcion_usuario';
	protected $primaryKey = 'suscripcion_usuario_id';
	protected $guarded =[];

	public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'usuario_id');
    }

    public function suscripcion()
    {
        return $this->belongsTo(Suscripcion::class, 'suscripcion_id', 'suscripcion_id');
    }
}
