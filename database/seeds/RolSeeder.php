<?php

use App\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Rol::create(['name' =>'Administrador']);
    	Rol::create(['name' =>'Usuario']);
    	Rol::create(['name' =>'Cliente']);
    }
}
