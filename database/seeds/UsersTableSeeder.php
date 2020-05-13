<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(['local_id' => 1,'name' => 'Administrador', 'email' => 'admin@fab.mil.br', 'password' => bcrypt(12345678), 'created_at' => now()]);
    }
}
