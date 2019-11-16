<?php

use App\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Producto::create(['name'=>'Producto 1', 'valor' => '1000', 'stock' => '10', 'descripcion' => 'Descripcion Producto 1']);
    	Producto::create(['name'=>'Producto 2', 'valor' => '2000', 'stock' => '20', 'descripcion' => 'Descripcion Producto 2']);
    	Producto::create(['name'=>'Producto 3', 'valor' => '2000', 'stock' => '20', 'descripcion' => 'Descripcion Producto 3']);
    	Producto::create(['name'=>'Producto 4', 'valor' => '2000', 'stock' => '20', 'descripcion' => 'Descripcion Producto 4']);
    	Producto::create(['name'=>'Producto 5', 'valor' => '2000', 'stock' => '20', 'descripcion' => 'Descripcion Producto 5']);
    }
}
