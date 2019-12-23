<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Categoria::create(['name' =>'Aceite']);
    	Categoria::create(['name' =>'Cereales']);
    	Categoria::create(['name' =>'Condimentos']);
    	Categoria::create(['name' =>'Picantes']);
    	Categoria::create(['name' =>'Salsas']);
    	Categoria::create(['name' =>'Snaks']);
    	Categoria::create(['name' =>'Conservas']);
    	Categoria::create(['name' =>'Manjares']);
    	Categoria::create(['name' =>'Mermeladas']);
    	Categoria::create(['name' =>'Mieles']);
    	Categoria::create(['name' =>'Mimbre']);
    	Categoria::create(['name' =>'Te e Infuciones']);
    	Categoria::create(['name' =>'Cafe']);
    	Categoria::create(['name' =>'Jugos']);
    }
}
