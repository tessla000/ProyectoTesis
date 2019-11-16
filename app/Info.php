<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
	use SoftDeletes;

	protected $table = 'info';
	protected $primaryKey = 'info_id';
	protected $guarded =[];

	public function usuario()
	{
		return $this->belongsTo(User::class, 'usuario_id', 'usuario_id');
	}

	public function getRouteKeyName()
	{
		return 'rut';
	}
}
