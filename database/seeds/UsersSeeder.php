<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create(['name' => 'Admin', 'email' => 'admin@admin.cl', 'password' => bcrypt('12345678'), 'rol_id' => 1]);
    	User::create(['name' => 'User 1', 'email' => 'user@user.cl', 'password' => bcrypt('12345678'), 'rol_id' => 2]);
        User::create(['name' => 'User 2', 'email' => 'user2@user.cl', 'password' => bcrypt('12345678'), 'rol_id' => 2]);
        User::create(['name' => 'Cliente 1', 'email' => 'cliente@cliente.cl', 'password' => bcrypt('12345678'), 'rol_id' => 3]);
        User::create(['name' => 'Cliente 2', 'email' => 'cliente2@cliente.cl', 'password' => bcrypt('12345678'), 'rol_id' => 3]);
    }
}
