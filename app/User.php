<?php

namespace App;

use App\Direccion;
use App\Info;
use App\Marca;
use App\Rol;
use App\Transaccion;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Favoriteability;

    protected $table = 'users';
    protected $primaryKey = 'usuario_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rol_id', 'confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'rol_id', 'confirmed'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function direcciones()
    {
        return $this->hasMany(Direccion::class, 'direccion_id', 'direccion_id');
    }

    public function infos()
    {
        return $this->hasMany(Info::class, 'info_id', 'info_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'rol_id');
    }

    public function marcas()
    {
        return $this->hasMany(Marca::class, 'marca_id', 'marca_id');
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
