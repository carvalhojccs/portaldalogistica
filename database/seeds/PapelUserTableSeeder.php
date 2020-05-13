<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PapelUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('papel_user')->insert(['user_id' => 1, 'papel_id' => 1,'created_at' => now()]);
    }
}
