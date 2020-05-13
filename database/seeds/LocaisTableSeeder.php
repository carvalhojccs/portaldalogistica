<?php

use App\Models\Local;
use Illuminate\Database\Seeder;


class LocaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Local::create(['nome' => 'Comissão de Aeroportos da Região Amazônica','sigla' => 'COMARA', 'created_at' => now()]);
        Local::create(['nome' => 'Destacamento de Apoio da COMARA em Manaus','sigla' => 'DACO-MN', 'created_at' => now()]);
        Local::create(['nome' => 'Destacamento de Apoio da COMARA em Moura','sigla' => 'DACO-OW', 'created_at' => now()]);
        Local::create(['nome' => 'Destacamento de Apoio da COMARA em Tabatinga','sigla' => 'DACO-TT', 'created_at' => now()]);
        Local::create(['nome' => 'Destacamento de Apoio da COMARA em São Gabriel da Cachoeira','sigla' => 'DACO-UA', 'created_at' => now()]);
        Local::create(['nome' => 'Destacamento de Engenharia da COMARA em Iauaretê','sigla' => 'DECO-YA', 'created_at' => now()]);
        Local::create(['nome' => 'Destacamento de Engenharia da COMARA em Estirão do Equador','sigla' => 'DECO-EE', 'created_at' => now()]);
        Local::create(['nome' => 'Destacamento de Engenharia da COMARA em Oriximiná','sigla' => 'DECO-OX', 'created_at' => now()]);
    }
}
