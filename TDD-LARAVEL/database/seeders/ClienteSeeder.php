<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('cliente')->insert([
            'dt_cadastro' => $faker->dateTime,
            'dt_situacao' => $faker->dateTime,
            'nu_telefone' => $faker->randomNumber(8),
            'nu_celular' => $faker->randomNumber(9),
            'nm_cliente' => $faker->name,
            'ds_razao_social' => $faker->randomNumber(9),
            'ds_nome_fantasia' => $faker->company,
            'nu_documento' => $faker->randomNumber(9),
            'dt_cadastro_cerc' => $faker->dateTime,
            'email' => $faker->email
        ]);
    }
}
