<?php

use App\Marca;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Marca::create(['name' =>'Sin Marca']);
    	Marca::create(['name' =>'Doña Juanita']);
    	Marca::create(['name' =>'San Pedro']);
    }
}
