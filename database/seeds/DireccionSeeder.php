<?php

use App\Direccion;
use Illuminate\Database\Seeder;

class DireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Direccion::create(['rut'=>'18.266.080-9', 'name'=>'Carlos', 'lastname' => 'Castro', 'codigoPostal' => '3360000', 'direccion1' => 'La Laguna S/N', 'descripcion' => 'Descripcion Direccion', 'comuna_id' => 122]);
    	Direccion::create(['rut'=>'11.762.078-6', 'name'=>'Maria', 'lastname' => 'Flores', 'codigoPostal' => '3340000', 'direccion1' => 'Curico S/N', 'descripcion' => 'Descripcion Direccion', 'comuna_id' => 115]);
        Direccion::create(['rut'=>'13.125.959-k', 'name'=>'Julieta', 'lastname' => 'Flores', 'codigoPostal' => '3340000', 'direccion1' => 'Teno S/N', 'descripcion' => 'Descripcion Direccion', 'comuna_id' => 122]);
    }
}
