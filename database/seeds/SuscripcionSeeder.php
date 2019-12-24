<?php

use App\Suscripcion;
use Illuminate\Database\Seeder;

class SuscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Suscripcion::create(['name' =>'Suscripción A', 'cantidad_productos' => 20]);
    	Suscripcion::create(['name' =>'Suscripción B', 'cantidad_productos' => 30]);
    	Suscripcion::create(['name' =>'Suscripción C', 'cantidad_productos' => 40]);
    }
}
