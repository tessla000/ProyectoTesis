<?php

namespace App;

use App\Direccion;
use App\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comuna extends Model
{
	use SoftDeletes;

	protected $table = 'comuna';
	protected $primaryKey = 'comuna_id';
	protected $guarded =[];

	public function region()
	{
		return $this->belongsTo(Region::class, 'region_id', 'region_id');
	}

	public function direcciones()
	{
		return $this->hasMany(Direccion::class, 'direccion_id', 'direccion_id');
	}

	public function getRouteKeyName()
    {
        return 'name';
    }
}
