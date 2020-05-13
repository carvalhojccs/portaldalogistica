<?php

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::insert(['nome' =>  'Acre','uf' =>  'AC', 'ibge' => 12 ]);
        Estado::insert(['nome' =>  'Alagoas','uf' =>  'AL', 'ibge' => 27 ]);
        Estado::insert(['nome' =>  'Amazonas','uf' =>  'AM', 'ibge' => 13 ]);
        Estado::insert(['nome' =>  'Amapá','uf' =>  'AP', 'ibge' => 16 ]);
        Estado::insert(['nome' =>  'Bahia','uf' =>  'BA', 'ibge' => 29 ]);
        Estado::insert(['nome' =>  'Ceará','uf' =>  'CE', 'ibge' => 23 ]);
        Estado::insert(['nome' =>  'Distrito Federal','uf' =>  'DF', 'ibge' => 53 ]);
        Estado::insert(['nome' =>  'Espí­rito Santo','uf' =>  'ES', 'ibge' => 32 ]);
        Estado::insert(['nome' =>  'Goiás','uf' =>  'GO', 'ibge' => 52 ]);
        Estado::insert(['nome' =>  'Maranhão','uf' =>  'MA', 'ibge' => 21 ]);
        Estado::insert(['nome' =>  'Minas Gerais','uf' =>  'MG', 'ibge' => 31 ]);
        Estado::insert(['nome' =>  'Mato Grosso do Sul','uf' =>  'MS', 'ibge' => 50 ]);
        Estado::insert(['nome' =>  'Mato Grosso','uf' =>  'MT', 'ibge' => 51 ]);
        Estado::insert(['nome' =>  'Pará','uf' =>  'PA', 'ibge' => 15 ]);
        Estado::insert(['nome' =>  'Paraí­ba','uf' =>  'PB', 'ibge' => 25 ]);
        Estado::insert(['nome' =>  'Pernambuco','uf' =>  'PE', 'ibge' => 26 ]);
        Estado::insert(['nome' =>  'Piauí­','uf' =>  'PI', 'ibge' => 22 ]);
        Estado::insert(['nome' =>  'Paraná','uf' =>  'PR', 'ibge' => 41 ]);
        Estado::insert(['nome' =>  'Rio de Janeiro','uf' =>  'RJ', 'ibge' => 33 ]);
        Estado::insert(['nome' =>  'Rio Grande do Norte','uf' =>  'RN', 'ibge' => 24 ]);
        Estado::insert(['nome' =>  'Rondônia','uf' =>  'RO', 'ibge' => 11 ]);
        Estado::insert(['nome' =>  'Roraima','uf' =>  'RR', 'ibge' => 14 ]);
        Estado::insert(['nome' =>  'Rio Grande do Sul','uf' =>  'RS', 'ibge' => 43 ]);
        Estado::insert(['nome' =>  'Santa Catarina','uf' =>  'SC', 'ibge' => 42 ]);
        Estado::insert(['nome' =>  'Sergipe','uf' =>  'SE', 'ibge' => 28 ]);
        Estado::insert(['nome' =>  'São Paulo','uf' =>  'SP', 'ibge' => 35 ]);
        Estado::insert(['nome' =>  'Tocantins','uf' =>  'TO', 'ibge' => 17 ]);
    }
}
