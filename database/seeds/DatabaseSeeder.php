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
        // $this->call(UserSeeder::class);

        //Orden de ejecucion de los seends para ingresar datos
        $this->call(WalletsTableSeeder::class); //Primero insertamos los datos puestos en WalletsTableSeeder
        $this->call(TransferTableSeeder::class);
    }
}
