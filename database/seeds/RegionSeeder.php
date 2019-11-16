<?php

use App\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create(['region_id' => '1','name' => 'I Región de Tarapacá']);
        Region::create(['region_id' => '2','name' => 'II Región de Antofagasta']);
        Region::create(['region_id' => '3','name' => 'III Región de Atacama']);
        Region::create(['region_id' => '4','name' => 'IV Región de Coquimbo']);
        Region::create(['region_id' => '5','name' => 'V Región de Valparaíso']);
        Region::create(['region_id' => '6','name' => 'VI Región del Libertador General Bernardo O’Higgins']);
        Region::create(['region_id' => '7','name' => 'VII Región del Maule']);
        Region::create(['region_id' => '8','name' => 'VIII Región del Biobío']);
        Region::create(['region_id' => '9','name' => 'IX Región de La Araucanía']);
        Region::create(['region_id' => '10','name' => 'X Región de Los Lagos']);
        Region::create(['region_id' => '11','name' => 'XI Región Aysén del General Carlos Ibáñez del Campo']);
        Region::create(['region_id' => '12','name' => 'XII Región de Magallanes y Antártica Chilena']);
        Region::create(['region_id' => '13','name' => 'Región Metropolitana de Santiago']);
        Region::create(['region_id' => '14','name' => 'XIV Región de Los Ríos']);
        Region::create(['region_id' => '15','name' => 'XV Región de Arica y Parinacota']);
        Region::create(['region_id' => '16','name' => 'XVI Región de Ñuble']);
    }
}
