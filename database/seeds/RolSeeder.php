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
    	Rol::create(['rol_id' => 1, 'name' =>'Administrador']);
    	Rol::create(['rol_id' => 2, 'name' =>'Usuario']);
    	Rol::create(['rol_id' => 3, 'name' =>'Cliente']);
    }
}
