<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'favorites';
    protected $primaryKey = 'user_id';
}
