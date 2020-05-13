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
        $this->call(LocaisTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PapeisTableSeeder::class);
        $this->call(PermissoesTableSeeder::class);
        $this->call(PapelUserTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
    }
}
