<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PosAplicativoSeeder extends Seeder
{
    protected  $fakerPos = ['cielo', 'alibin', 'paypal', 'mercadopago'];

    public function run()
    {
        $faker = Faker::create();
        DB::table('pos_aplicativo')->insert([
            'nm_pos_aplicativo' =>  Arr::random($this->fakerPos),
            'nr_versao' => $faker->randomNumber(3),
            'tp_principal' => false,
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
        ]);
    }
}
