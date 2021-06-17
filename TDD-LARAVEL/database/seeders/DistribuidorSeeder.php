<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistribuidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('distribuidor')->insert([
            'dt_cadastro' => $faker->dateTime,
            'nu_telefone' => $faker->randomNumber(8),
            'nu_celular' => $faker->randomNumber(9),
            'nm_distribuidor' => $faker->name,
            'ds_razao_social' => $faker->randomNumber(9),
            'ds_nome_fantasia' => $faker->company,
            'nu_documento' => $faker->randomNumber(9),
        ]);
    }
}
