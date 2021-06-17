<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PosSeeder extends Seeder
{
    protected $fakerNamePos = ['pax', 'pac','gertec','az'];
    protected $fakerModelPos = ['200', '2000','150','3000'];

    public function run()
    {
        $faker = Faker::create();
        DB::table('pos')->insert([
            'nm_pos' => Arr::random($this->fakerNamePos),
            'nm_modelo' => Arr::random($this->fakerModelPos),
            'nm_terminal' => $faker->randomNumber(9),
            'nr_serie' => $faker->randomNumber(9),
            'id_pos_situacao' => '1',
            'id_distribuidor' => '1',
            'id_cliente' => '1',
            'id_pos_aplicativo' => '1',
            'nu_pos' => $faker->randomNumber(9),
            'created_at' => $faker->dateTime
        ]);
    }
}
