<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
	use SoftDeletes;

	protected $table = 'region';
	protected $primaryKey = 'region_id';
	protected $guarded =[];

	public function comunas()
	{
		return $this->hasMany(Comuna::class, 'comuna_id', 'comuna_id');
	}

	public function getRouteKeyName()
    {
        return 'name';
    }
}
