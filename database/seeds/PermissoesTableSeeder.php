<?php

use App\Models\Papel;
use Illuminate\Database\Seeder;

class PermissoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Papel::insert(['nome' => 'Administrador', 'descricao' => 'Administrador do sistema', 'created_at' => now()]);
    }
}
