<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call
        (
        	[
                RegionSeeder::class,
                ComunaSeeder::class,
                // DireccionSeeder::class,
                CategoriaSeeder::class,
                // MarcaSeeder::class,
                // ProductoSeeder::class,
                RolSeeder::class,
                UsersSeeder::class,
                SuscripcionSeeder::class
            ]
        );
    }
}
