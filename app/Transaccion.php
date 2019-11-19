<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaccion extends Model
{
	use SoftDeletes;

	protected $table = 'transaccion';
	protected $primaryKey = 'transaccion_id';
	protected $guarded =[];
}
